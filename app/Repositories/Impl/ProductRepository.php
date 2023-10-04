<?php

namespace App\Repositories\Impl;

use App\Models\Product;
use App\Repositories\Eloquent\EloquentRepository;
use App\Repositories\IProductRepository;

class ProductRepository extends EloquentRepository implements IProductRepository
{

    public function getModel()
    {
        return Product::class;
    }
}
