<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationProduct;
use App\Http\Services\ProductService;
use App\Models\Category;
use App\Models\Product;
use App\Services\IProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    private IProductService $productService;
    public function __construct(IProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        // Log sẽ được lưu ở storage/logs/laravel.logs
        Log::debug('Xử lý url /index');
        $products = $this->productService->getAll();
        $categories = Category::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();  // eloquent
        // $categories = DB::table('categories')->get();
        return view('products.create', compact('categories'));
    }


    public function save(ValidationProduct $validateProductRequest)
    {
        // dd($validateProductRequest->all());          // Xem dữ liệu gửi về có đúng ko
        // ValidationProduct: tìm hiểu về tạo FormRequest để validate
        $data = $validateProductRequest->all();
        // DB::table('products')->insert([
        //     "name" => $data["name"],
        //     "description" => $data["description"],
        //     "category_id" => $data["category_id"],
        //     "price" => $data["price"],
        //     "status" => 0,
        // ]);

        $p = new Product();
        $p->fill($data);


        DB::table('products')->insert((array) $p->attributes);
        // $this->productService->create($validateProductRequest->all());
        return redirect()->route('products.index')->with("msg", "Add product success")->with('msgAction', 'success');
    }

    /*
    public function save(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'regex:/^[a-z A-Z0-9]{2,20}$/'],
                'description' => ['required', 'regex:/^[a-z A-Z0-9]{2,50}$/'],
                'category_id' => ['required', 'numeric'],
                'price' => ['required', 'numeric'],
            ],
            [
                'name.required' => 'Tên phải được nhập',
                'name.regex' => 'Tên chưa hợp lệ. Phải từ 2-20 chữ cái',
                'description.regex' => 'Thông tin mô tả chưa hợp lệ. Từ 2-50 chữ cái',
                'category_id.regex' => 'Danh mục phải là số',
                'price.regex' => 'Giá không hợp lệ',
            ]

        );
        $this->productService->create($request->all());
        return redirect()->route('products.index')->with("msg", "Add product success")->with('msgAction', 'success');
    }
*/

    public function edit($id = 0, Request $request)
    {

        $categories = Category::all();
        $product = null;
        if (!empty($id)) {
            $product = $this->productService->findById($id);
            // dd(Product::where('id', 8)->get()->toArray());
            ///Nhasanxuat::where(fieldName,Operator, value)

            if ($product == null) {
                return redirect()->route('products.index')->with("msg", "Product not found")->with('msgAction', 'error');
            } else {
                return view('products.edit', compact('product', 'categories'));
            }
        } else {
            return redirect()->route('products.index')->with("msg", "Id Product not valid")->with('msgAction', 'error');
        }
    }


    public function update(ValidationProduct $request, $id)
    {
        $product = null;
        if (!empty($id)) {
            $product = $this->productService->findById($id);
            if ($product == null) {
                return redirect()->route('products.index')->with("msg", "Product not found")->with('msgAction', 'error');
            } else {
                $this->productService->update($request->all(), $id);
                return redirect()->route('products.index')->with("msg", "Edit Product success")->with('msgAction', 'success');
            }
        } else {
            return redirect()->route('products.index')->with("msg", "Id Product not valid")->with('msgAction', 'error');
        }
    }

    public function destroy($id)
    {
        $product = $this->productService->destroy($id);
    }
}
