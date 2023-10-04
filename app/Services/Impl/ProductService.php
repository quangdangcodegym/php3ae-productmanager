<?php

namespace App\Services\Impl;

use App\Repositories\IProductRepository;
use App\Services\IProductService;

class ProductService implements IProductService
{
    protected $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function findById($id)
    {
        $product = $this->productRepository->findById($id);

        return $product;
    }

    public function create($request)
    {
        $this->productRepository->create($request);
    }

    public function update($request, $id)
    {
        $oldProduct = $this->productRepository->findById($id);

        $newProduct = $this->productRepository->update($request, $oldProduct);
        return $newProduct;
    }

    public function destroy($id)
    {
        $product = $this->productRepository->findById($id);
        if ($product) {
            $this->productRepository->destroy($product);
        }
    }
}
