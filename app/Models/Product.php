<?php

namespace App\Models;

use App\Models\Media;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Plank\Mediable\Mediable;

class Product extends Model implements Buyable
{

    use Sluggable,
        SluggableScopeHelpers,
        Mediable;

    protected $fillable = [
        'title',
        'description',
        'price',
        'status',
        'form_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if (!$model->hasMedia('gallery')) {
                return;
            }

            $model->getMedia('gallery')->each(function ($item, $key) {
                $item->delete();
            });
        });
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function setTitleAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['title'] = '';
        }
        $this->attributes['title'] = $value;
    }


    public function meta()
    {
        return $this->hasMany('App\Models\ProductMeta', 'product_id');
    }


    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'service_id')->where('parent', 0);
    }

    // Post model
    public function nestedComments()
    {

    }


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function terms()
    {
        return $this->belongsToMany('App\Models\Term', 'term_relationships')->using(ProductTerm::class);
    }


    public function addons()
    {
        return $this->belongsToMany('App\Models\Addon', 'addon_product')->withPivot('price');
    }


    /**
     * This function is used to retrieve
     * formatted price with currency symbol
     *
     * @return string
     */
    public function getDisplayPriceAttribute()
    {
        $currency_position = setting('currency_position', 'left');
        if ($currency_position == 'left') {
            return ch_currency_symbol(setting('currency', 'USD')) . $this->attributes['price'];
        } elseif ($currency_position == 'right') {
            return $this->attributes['price'] . ch_currency_symbol(setting('currency', 'USD'));
        } elseif ($currency_position == 'left_space') {
            return ch_currency_symbol(setting('currency', 'USD')) . ' ' . $this->attributes['price'];
        } elseif ($currency_position == 'right_space') {
            return $this->attributes['price'] . ' ' . ch_currency_symbol(setting('currency', 'USD'));
        }
    }


    /**
     * This method is used to get delivery time
     * of the service.
     *
     * @return string|null
     */
    public function getTurnAroundAttribute()
    {
        $delivery_time = $this->meta()->where('key', 'delivery_time')->first();
        return (isset($delivery_time->value)) ? $delivery_time->value : NULL;
    }


    /**
     * This method is used to get revisions
     * of the service.
     *
     * @return string|null
     */
    public function getRevisionsAttribute()
    {
        $revisions = $this->meta()->where('key', 'revisions')->first();
        return (isset($revisions->value)) ? $revisions->value : NULL;
    }


    public function getTermListAttribute()
    {
        return $this->terms()->pluck('id')->all();
    }


    public function getServiceMetaAttribute()
    {
        return $this->meta()->pluck('value', 'key')->all();
    }

    public function getVariablePricingEnabledAttribute()
    {
        $val = $this->meta()->where('key', 'variable_pricing_enabled')->pluck('value')->first();

        return (isset($val)) ? true : false;
    }

    public function getDefaultPriceAttribute()
    {
        return $this->meta()->where('key', 'default_price_id')->pluck('value')->first();
    }


    public function getVariablePriceAttribute()
    {

        $varPriceEnabled = $this->meta()->where('key', 'variable_pricing_enabled')->pluck('value')->first();
        $varPrice = $this->meta->where('key', 'variable_prices')->first();

        return ($varPriceEnabled != 0) ? $varPrice->value : null;

    }


    public function scopePublished($query)
    {

        $query->where('status', 'publish');

    }


    public function scopeUnPublished($query)
    {

        $query->where('status', 'draft');

    }


    public function tasks()
    {
        return $this->hasMany(Task::class, 'object_id', 'id');
    }

    public function form()
    {
        return $this->hasOne(Form::class, 'id', 'form_id');
    }

    public function hasMeta($key)
    {
        $meta = $this->meta;

        foreach ($meta as $item):
            if ($item->key == $key && !is_null($item->value)) return true;
        endforeach;

        return false;
    }


    public function getMeta($key)
    {
        $meta = $this->meta;

        foreach ($meta as $item):
            if ($item->key == $key) return $item->value;
        endforeach;

        return null;
    }

    /**
     * Get the identifier of the Buyable item.
     *
     * @return int|string
     */
    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    /**
     * Get the description or title of the Buyable item.
     *
     * @return string
     */
    public function getBuyableDescription($options = null)
    {
        return $this->title;
    }

    /**
     * Get the price of the Buyable item.
     *
     * @return float
     */
    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }

    /**
     * @param string $slug
     * @param array $columns
     * @return mixed
     */
    public static function findBySlug(string $slug, array $columns = ['*'])
    {
        $slug = utf8_uri_encode($slug);

        return static::whereSlug($slug)->first($columns);
    }

    /**
     * @param string $slug
     * @param array $columns
     * @return mixed
     */
    public static function findBySlugOrFail(string $slug, array $columns = ['*'])
    {
        $slug = utf8_uri_encode($slug);

        return static::whereSlug($slug)->firstOrFail($columns);
    }
}
