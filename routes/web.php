<?php

use Illuminate\Support\Facades\Route;
use App\Product;
use App\Image;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    $products = Product::inRandomOrder()->limit(5)->get();
    $carousels = Image::where('type',Image::CAROUSEL)->get();
    $galeries = Image::where('type',Image::GALERY)->get();
    return view('pages.start',compact(['products','carousels','galeries']));
})->name('index');

//about us
Route::get('/about',function()
{
    return view('pages.about');
}
)->name('aboutUs');

//products Area
Route::get('/products','ProductController@showAllProducts')->name('show.all.products');

Route::get('/product/{id}/info','ProductController@productInfo')->name('product.info');

//orders area

Route::get('/orders/{id}/download','OrderController@downloadOrderPDF')->name('downloadPDF');

Route::get('/orders','OrderController@ordersView')->name('orders');

Route::get('/order/new','OrderController@createOrder')->name('new.order');

Route::get('order/{id}/list/products','OrderController@userListOrder')->name('user.list.order');

//cancel order
Route::put('/order/{id}/cancel','AdminController@cancelOrder')->name('cancelOrder');
//user area

Route::get('/profile','HomeController@userProfile')->name('profile');

Route::put('/profile/update','HomeController@updateUserData')->name('user.update.data');

Route::post('/product/{id}/add-cart','CartController@addCart')->name('add.product.cart');

Route::get('/product/cart/clear','CartController@clearCart')->name('clear.cart');

Route::put('/product/cart/{id}/change','CartController@changeQuantityCart')->name('update.qty.prod.cart');

Route::get('/product/cart/detail','CartController@cartDetail')->name('cart.detail');

Route::post('/product/cart/{id}/drop','CartController@cartDropItem')->name('cart.drop.item');

Route::get('/cart','CartController@cardShow')->name('cart');

//autentication routes

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//ADMIN AREA
Route::get('/panel/order/{id}/download','AdminController@downloadOrder')->name('admin.download.order');

Route::get('/panel/admin','AdminController@index')->name('panel.admin');

Route::get('/panel/admin/create-product','AdminController@createProduct')->name('panel.admin.create-product');

Route::post('/panel/admin/add-product','AdminController@addNewProduct')->name('panel.admin.addProduct');

Route::get('/panel/admin/{id}/edit-product','AdminController@editProductView')->name('admin.edit.product');

Route::put('/panel/admin/{id}/edit-product','AdminController@editProduct')->name('admin.editProduct');

Route::delete('/panel/admin/{id}/delete','AdminController@deleteProduct')->name('admin.delete.product');

Route::get('/panel/admin/users','AdminController@AdministrateUsers')->name('admin.users');

Route::get('/panel/admin/crate-user','AdminController@createUserView')->name('admin.create.user');

Route::post('/panel/admin/new-user','AdminController@newUser')->name('admin.new.user');

Route::get('/panel/admin/{id}/movements','AdminController@userMovements')->name('admin.user.movements');

Route::delete('/panel/admin/user/{id}/delete','AdminController@deleteUser')->name('admin.delete.user');

Route::get('/panel/admin/image','AdminController@imageViewPanel')->name('admin.image.view');

Route::get('/panel/admin/new-image','AdminController@addImage')->name('image.add.image');

Route::post('/panel/admin/new-image','AdminController@addNewImage')->name('admin.addNewImage');

Route::get('/panel/admin/{id}/image-edit','AdminController@editImageContent')->name('admin.edit.image');

Route::put('/panel/admin/{id}/imsge-edit','AdminController@editedImageContent')->name('admin.edited.image');

Route::delete('/panel/admin/{id}/image-delete','AdminController@deleteImageContent')->name('admin.delete.image');

Route::get('/panel/admin/categories','AdminController@categoriesView')->name('admin.categories.view');

Route::post('/panel/admin/categories','AdminController@AddCategory')->name('add.category');

Route::get('/panel/admin/{id}/category','AdminController@editCategoryView')->name('admin.edit.category');

Route::put('/panel/admin/{id}/category','AdminController@editedCategory')->name('admin.edited.category');

Route::delete('/panel/admin/{id}/category','AdminController@deleteCategory')->name('admin.delete.category');

Route::post('/panel/admin/subcategory','AdminController@addSubcategory')->name('admin.add.subcategory');

Route::get('/panel/admin/{id}/subcategory','AdminController@editSubcategory')->name('admin.edit.subCategory');

Route::put('/panel/admin/{id}/subcategory','AdminController@editedSubcategory')->name('admin.edited.subCategory');

Route::delete('/panel/admin/{id}/subcategory','AdminController@deleteSubcategory')->name('admin.delete.subCategory');

Route::get('/panel/admin/units','AdminController@unitsView')->name('admin.units.view');

Route::post('/panel/admin/add-unit','AdminController@addUnit')->name('admin.add.unit');

Route::get('/panel/admin/{id}/edit-unit','AdminController@editUnit')->name('admin.edit.unit');

Route::put('/panel/admin/{id}/edit-unit','AdminController@editedUnit')->name('admin.edited.unit');

Route::delete('/panel/admin/{id}/delete-unit','AdminController@deleteUnit')->name('admin.delete.unit');

Route::get('/panel/admin/orders','AdminController@ordersView')->name('admin.orders.view');

Route::put('/panel/admin/{id}/sended','AdminController@orderSended')->name('admin.order.sended');

Route::get('/panel/admin/{id}/list','AdminController@listOrder')->name('admin.list.order');