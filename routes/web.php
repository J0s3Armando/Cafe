<?php

use Illuminate\Support\Facades\Route;
use illuminate\Http\Request;
use App\Product;

Route::get('/', function () {
    $products = Product::limit(8)->get();
    return view('pages.start',compact('products'));
})->name('inicio');

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
})->name('profile')->middleware('auth');

Route::get('/myshopping',function(){
    return view('pages.shopping');
})->name('shopping')->middleware('auth');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/panel/admin',function(){
    if(auth()->user()->level=='1')
    {
        return 'panel de admin';
    }
    return redirect()->route('inicio')->with('info','Acceso no permitido para este ususario');
})->name('panel.admin')->middleware('auth');

