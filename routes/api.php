<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlacesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Aqui você pode registrar as rotas da sua API.
| Elas serão automaticamente prefixadas com /api.
*/

Route::middleware('api')->group(function () {
    Route::apiResource('places', PlacesController::class);
});
