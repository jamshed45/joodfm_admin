<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\FrontendController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/translations', [FrontendController::class, 'translations']);
Route::get('/hero-slides', [FrontendController::class, 'heroSlides']);
Route::get('/client-logos', [FrontendController::class, 'clientLogos']);
Route::get('/projects', [FrontendController::class, 'projects']);
Route::post('/contact', [FrontendController::class, 'contactUs']);
Route::post('/career', [FrontendController::class, 'Career']);



Route::get('/settings', [SettingController::class, 'index']);
