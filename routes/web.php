<?php

use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ClientLogoController;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


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



Route::group(['middleware' => 'auth'], function () {
    Route::get('/index', [DashboardController::class, 'index'])->name('index');

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::resource('client-logos', ClientLogoController::class);
    Route::resource('certificates', CertificateController::class);
    Route::resource('hero-slides', HeroSliderController::class);
    Route::resource('jobs', JobController::class);
    Route::resource('projects', ProjectController::class);




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/site-setting', [SettingController::class, 'siteSetting'])->name('view.siteSetting');
    Route::get('/site-setting-all', [SettingController::class, 'siteSettingAll'])->name('view.siteSettingAll');
    Route::get('/social-media-setting', [SettingController::class, 'social_media_setting'])->name('view.social-media-setting');

    Route::put('settings/{setting?}', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('/settings', SettingController::class);


});


Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage linked successfully!';
});

Route::get('/check-storage-link', function () {
    $linkPath = public_path('storage');
    $targetPath = storage_path('app/public');

    if (file_exists($linkPath)) {
        if (is_link($linkPath)) {
            $actualTarget = readlink($linkPath);
            return "✅ Storage link exists. It points to: <br>$actualTarget";
        } else {
            return "⚠️ A folder named 'storage' exists in /public but it's not a symlink.";
        }
    } else {
        return "❌ No storage link found. Run <code>php artisan storage:link</code>.";
    }
});
