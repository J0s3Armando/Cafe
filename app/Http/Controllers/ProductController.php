<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Product;
class ProductController extends Controller
{
    //
    public function productInfo($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.product-info',compact('product'));
    }
    
    public function showAllProducts()
    {
        $products = Product::orderBy('id_units','desc')->paginate(8);
        return view('pages.all-products',compact('products'));
    }
}
