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

Route::post('/panel/admin/add-product','AdminController@addNewProduct')->name('panel.admin.addProduct');

Route::get('/panel/admin/{id}/edit-product','AdminController@editProductView')->name('admin.edit.product');

Route::put('/panel/admin/{id}/edit-product','AdminController@editProduct')->name('admin.editProduct');

Route::delete('/panel/admin/{id}/delete','AdminController@deleteProduct')->name('admin.delete.product');

Route::get('/panel/admin/users','AdminController@AdministrateUsers')->name('admin.users');

Route::get('/panel/admin/crate-user','AdminController@createUserView')->name('admin.create.user');

Route::post('/panel/admin/new-user','AdminController@newUser')->name('admin.new.user');

Route::delete('/panel/admin/user/{id}/delete','AdminController@deleteUser')->name('admin.delete.user');

Route::get('/panel/admin/carousel','AdminController@carouselViewPanel')->name('admin.carousel.view');

Route::get('/panel/admin/new-image','AdminController@addCarouselImage')->name('carousel.add.image');

Route::post('/panel/admin/new-image','AdminController@addNewImageCarousel')->name('admin.addNewImageToCarousel');

Route::get('/panel/admin/{id}/carousel-edit','AdminController@editCarouselContent')->name('admin.edit.carousel');

Route::put('/panel/admin/{id}/carousel-edit','AdminController@editedCarouselContent')->name('admin.edited.carousel');

Route::delete('/panel/admin/{id}/carousel-delete','AdminController@deleteCarouselContent')->name('admin.delete.carousel');