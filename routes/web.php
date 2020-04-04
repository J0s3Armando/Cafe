<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.start');
})->name('inicio');

Route::get('/login',function()
{
    return view('pages.login');
})->name('login');

Route::get('/register',function()
{
    return view('pages.register');
})->name('register');
