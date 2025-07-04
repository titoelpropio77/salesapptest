<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PdfController;

Route::get('/products', [ProductController::class, 'index']);

Route::post('/orders', [OrderController::class, 'store']);


Route::get('/orders/{order}/pdf', [PdfController::class, 'generate']);
