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
}
