<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;

Route::get('/hello', function () {
	return ['message' => 'Hello from API'];
});