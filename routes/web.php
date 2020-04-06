<?php

use Illuminate\Support\Facades\Route;
use illuminate\Http\Request;
use App\Product;

Route::get('/', function () {
    $products = Product::all();
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
