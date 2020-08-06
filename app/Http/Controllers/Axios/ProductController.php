<?php

namespace App\Http\Controllers\Axios;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(StoreProduct $request)
    {

        $product = Product::create([
            'name' => $request['name'],
            'description' => $request['description']
        ]);

        return $product;
    }

    public function getAll()
    {
        $products = Product::all();

        return $products;
    }

    public function removeProduct(Product $product)
    {
        try{
            $product->delete();
        } catch (\Exception $e){
            return $e;
        }
    }
}
