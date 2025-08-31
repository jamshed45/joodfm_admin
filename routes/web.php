<?php


use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ClientLogoController;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\RoleController;

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::resource('organizations', OrganizationController::class);

    // Route::resource('organizations', OrganizationController::class);

});

Route::group(['middleware' => ['auth', 'role:organization']], function () {

    Route::resource('organizations', OrganizationController::class);

});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/index', [DashboardController::class, 'index'])->name('index');

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::resource('client-logos', ClientLogoController::class);
    Route::resource('hero-slides', HeroSliderController::class);




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/site-setting', [SettingController::class, 'siteSetting'])->name('view.siteSetting');
    Route::get('/social-media-setting', [SettingController::class, 'social_media_setting'])->name('view.social-media-setting');

    Route::put('settings/{setting?}', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('/settings', SettingController::class);

});
