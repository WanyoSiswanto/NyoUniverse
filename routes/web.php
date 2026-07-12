<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/frontend', function () {
    return redirect('/frontend/index.html');
});