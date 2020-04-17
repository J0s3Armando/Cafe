<?php

use Illuminate\Support\Facades\Route;
use illuminate\Http\Request;
use App\Product;
use App\Carousel;
use App\Category;

Route::get('/', function () {
    $products = Product::limit(8)->get();
    $carousels = Carousel::all();
    return view('pages.start',compact(['products','carousels']));
})->name('index');

//products Area

Route::get('/product/{id}','ProductController@productInfo')->name('product.info');

//user area

Route::get('/profile','HomeController@userProfile')->name('profile');

Route::get('/myshopping','HomeController@userShopping')->name('shopping');

//autentication routes

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//ADMIN AREA
Route::get('/panel/admin','AdminController@index')->name('panel.admin');

Route::get('/panel/admin/create-product','AdminController@createProduct')->name('panel.admin.create-product');

Route::post('/panel/admin/add-Product','AdminController@addNewProduct')->name('panel.admin.addProduct');

Route::get('/panel/admin/{id}/edit-product','AdminController@editProduct')->name('admin.edit.product');

Route::delete('/panel/admin/{id}/delete','AdminController@deleteProduct')->name('admin.delete.product');