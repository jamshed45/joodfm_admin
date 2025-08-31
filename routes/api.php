<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SettingController;
use App\Models\ClientLogo;
use App\Models\HeroSlider;
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
            'aboutTitle' => 'Jood FM ® is an integrated Facilities Management company',
            'aboutDesc' => 'Jood FM ® is an integrated Facilities Management company that provides complete solutions/services to all kind of businesses and government sectors. Due to the increase demand and the great success the Quick Kangaroo ® brand has accomplished during the past years by providing an outstanding maintenance services to residential customers of compounds and housing owners/tenants; the board of directors decided to diversify with a new brand named Jood FM ® to focus only on commercial sector aiming to provide higher standard in facility management services.',
        ],
        'ar' => [
            'whoWeAre' => 'من نحن؟',
            'aboutTitle' => 'جود إف إم ® هي شركة إدارة مرافق متكاملة',
            'aboutDesc' => 'جود إف إم ® هي شركة متكاملة لإدارة المرافق، تقدم حلولًا وخدمات شاملة لجميع أنواع الأعمال والقطاعات الحكومية. ونظرًا لزيادة الطلب والنجاح الكبير الذي حققته علامة الكنغر السريع ® خلال السنوات الماضية من خلال تقديم خدمات صيانة متميزة للعملاء السكنيين في المجمعات السكنية وأصحاب/مستأجري المنازل؛ قرر مجلس الإدارة التنويع بإطلاق علامة تجارية جديدة باسم جود إف إم ® للتركيز فقط على القطاع التجاري، بهدف تقديم مستوى أعلى من خدمات إدارة المرافق.',
        ],
    ];

    return response()->json($translations[$lang] ?? $translations['en']);
});

Route::get('/hero-slides', function () {
    $slides = HeroSlider::all()->map(function ($slide) {
        return asset('storage/' . $slide->image);
    });

    return response()->json([
        'slides' => $slides
    ], 200, [], JSON_UNESCAPED_UNICODE);
});




Route::get('/client-logos', function () {

    $logos = ClientLogo::all()->map(function ($logo) {
        return asset('storage/' . $logo->image);
    });

    return response()->json([
        'logos' => $logos
    ]);
});


Route::get('/settings', [SettingController::class, 'index']);
