<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

// *----------------* //

Route::get('/' , [HomeController::class , "index"])->name("home.index");

//* IMAGE VIEWS
Route::get('/images' , [ImageController::class , "index"])->name("images.index");

//* FUNCTIONS
Route::post('/images/store' , [ImageController::class , "store"])->name("images.store");
Route::delete('/images/{image}/destroy' , [ImageController::class , "destroy"])->name("images.destroy");
Route::put('/images/{image}/update' , [ImageController::class , "update"])->name("images.update");