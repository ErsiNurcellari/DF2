<?php

namespace App\Repositories;


use App\Models\ProductMeta;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Addon;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\Products\ProductNotFoundException;
use App\Exceptions\Products\CreateProductInvalidArgumentException;
use \Illuminate\Database\QueryException;

class ProductRepository
{
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function createOrUpdate(array $data, $update = false, $id = null)
    {
        try {
            $product = $update == true ? $this->model->find($id) : new $this->model;
            $product->title = $data['title'];
            $product->description = $data['description'];
            $product->price = $data['price'];
            $product->user_id = $data['user_id'];
            $product->form_id = $data['form_id'];
            $product->status = (isset($data['save'])) ? 'draft' : 'publish';

            if ($update == true) {
                $product->update();
            } else {
                $product->save();
            }

            $addons_data = [];

            if (!empty($data['addons'])) {
                foreach ($data['addons']['name'] as $key => $value) {
                    if (empty($value)) {
                        continue;
                    }

                    if (isset($data['addons']['id'][$key])) {

                        $addons_data[$data['addons']['id'][$key]] = ['price' => $data['addons']['price'][$key]];
                    } else {
                        $addon = Addon::create(['name' => $value]);
                        $addons_data[$addon->id] = ['price' => $data['addons']['price'][$key]];
                    }
                }

                // [id => ['price' => '10.00'], id => ['price' => '10.00']]
                $product->addons()->sync($addons_data);
            }

            if (isset($data['term_list']) && !empty($data['term_list'])) {

                $selected_cats = $data['term_list'];

                $terms = [];

                foreach ($selected_cats as $cat) {
                    $terms = array_merge($terms, get_term_parent_ids($cat));
                }

                $product->terms()->sync(array_unique($terms));
            }

            if (isset($data['tasks']) && !empty($data['tasks']) && !empty(array_filter($data['tasks']))) {
                $product->tasks()->delete();

                foreach ($data['tasks'] as $task) {
                    if ( $task == '') {
                        continue;
                    }

                    $product->tasks()->save(new Task(['name' => $task]));
                }
            }

            if (isset($data['meta']) && !empty($data['meta'])) {
                foreach ( $data['meta'] as $key => $value) {
                    if ($key == 'service_images') {
                        $product->syncMedia($value, 'gallery');
                    } elseif($key == 'attachments') {
                        $product->syncMedia($value, 'attachments');
                    } else {
                        $value = is_array($value) ? serialize($value) : $value;
                        $product->meta()->updateOrCreate(['key' => $key], ['value' => $value]);
                    }
                }
            }

            return $product;

        } catch (QueryException $e) {
            throw new CreateProductInvalidArgumentException($e->getMessage(), 500, $e);
        }


    }

    public function find($id)
    {
        try {
            return $this->model::with(['meta'])->findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            throw new ProductNotFoundException($ex);
        }
    }

    public function delete($id)
    {
        $product = $this->find($id);

        $product->tasks()->delete();

        $product->meta()->delete();

        $product->terms()->sync([]);

        $product->addons()->sync([]);

        $product->delete();

        return true;
    }

}
