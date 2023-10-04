<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('categories')->insert([
        //     "name" => "Phone"
        // ]);
        // DB::table('categories')->insert([
        //     "name" => "Laptop"
        // ]);

        // Dùng olequent thì có tự động cập nhật timestamp
        $product = new Product();
        $product->name = "Iphone 11";
        $product->description = "Iphone 11 dep lam";
        $product->status = false;
        $product->price = 10000;
        $product->category_id = 1;

        $product->save();
    }
}
