<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SettingController;

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


Route::get('/translations', function (Request $request) {
    $lang = $request->query('lang', 'en'); // default to 'en'

    // Hardcoded example
    $translations = [
        'en' => [
            'whoWeAre' => 'Who We Are?',
            'aboutTitle' => 'Jood FM ® is an integrated Facilities Management company adasdasd',
            'aboutDesc' => 'Jood FM ® is an integrated Facilities Management company that provides complete solutions/services...',
        ],
        'ar' => [
            'whoWeAre' => 'من نحن؟',
            'aboutTitle' => 'جود إف إم ® هي شركة إدارة مرافق متكاملة',
            'aboutDesc' => 'جود إف إم ® هي شركة إدارة مرافق متكاملة تقدم حلولًا وخدمات كاملة...',
        ],
    ];

    return response()->json($translations[$lang] ?? $translations['en']);
});


Route::get('/client-logos', function () {
    return response()->json([
        'logos' => [
            asset('storage/upload/clients/cl-logo.png'),
            asset('storage/upload/clients/cl-logo.png'),
            asset('storage/upload/clients/cl-logo.png'),
            asset('storage/upload/clients/cl-logo.png'),
            asset('storage/upload/clients/cl-logo.png'),
            asset('storage/upload/clients/cl-logo.png'),
            asset('storage/upload/clients/cl-logo.png'),
            asset('storage/upload/clients/cl-logo.png'),
            asset('storage/upload/clients/cl-logo.png'),
            asset('storage/upload/clients/cl-logo.png'),
            asset('storage/upload/clients/cl-logo.png'),
            asset('storage/upload/clients/cl-logo.png'),
        ]
    ]);
});


Route::get('/settings', [SettingController::class, 'index']);
