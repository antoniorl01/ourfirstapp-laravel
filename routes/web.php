<?php

use App\Http\Controllers\ExampleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ExampleController::class, "welcomepage"]);

Route::get('/home', [ExampleController::class, "homepage"]);

Route::get('/about', [ExampleController::class, "aboutpage"]);

Route::post('/registration', [UserController::class, "register_user"]);

