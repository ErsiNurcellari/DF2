<?php
namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Events\Dispatcher;

class ProductService
{
    private $auth;

    private $dispatcher;

    private $productRepository;

    private $productValidator;

    public function __construct(
        Dispatcher $dispatcher,
        ProductRepository $productRepository
    ) {
        $this->dispatcher = $dispatcher;
        $this->productRepository = $productRepository;
    }

    public function create(array $data)
    {
        $product = $this->productRepository->createOrUpdate($data);
        return $product;
    }
    
    
    public function find($id) 
    {
        return $this->productRepository->find($id);
    }

    public function update($data, $id)
    {
        $product = $this->productRepository->createOrUpdate($data, true, $id);

        return $product;
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }
}