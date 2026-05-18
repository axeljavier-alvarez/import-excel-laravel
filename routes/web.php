<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('upload-excel');
});

Route::get('/upload-excel', function(){
    return view('upload-excel');
});