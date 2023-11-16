<?php

use Illuminate\Support\Facades\Route;
use Theme\TestTheme\Http\Controllers\Frontend\FrontendController;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/blog/{permalink}', [FrontendController::class, 'details'])->name('blog.details');
