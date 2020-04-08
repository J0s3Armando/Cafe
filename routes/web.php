<?php

use Illuminate\Support\Facades\Route;
use illuminate\Http\Request;
use App\Product;

Route::get('/', function () {
    $products = Product::limit(8)->get();
    return view('pages.start',compact('products'));
})->name('inicio');

Route::get('/login',function()
{
    return view('pages.login');
})->name('login');

Route::get('/register',function()
{
    return view('pages.register');
})->name('register');

Route::get('/product/{id}',function($id){
    try{
        $product = Product::findOrFail($id);
    }
    catch(Illuminate\Database\Eloquent\ModelNotFoundException $e)
    {
        return redirect()->route('inicio')->with('info','El producto no ha sido encontrado');
    }
    return view('pages.product-info',compact('product'));
    
})->name('product.info');

Route::get('/profile',function(){
    return view('pages.profile');
})->name('profile');

Route::get('/logout',function(){
    return 'salir';
})->name('logout');

Route::get('/myshopping',function(){
    return view('pages.shopping');
})->name('shopping');

Route::get('/admin',function(){
  return view('admin.index');  
})->name('admin.principal');