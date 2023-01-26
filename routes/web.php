<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::resource('users', UserController::class);

    Route::get('change-category-status', [CategoryController::class, 'changeCategoryStatus']);
    Route::get('trashed-categories', [CategoryController::class, 'trashed'])->name('category.trashed');
    Route::post('categories/{category}/restore',[CategoryController::class,'restore'])->name('category.restore');
    Route::post('categories/{category}/force-delete',[CategoryController::class,'forceDelete'])->name('category.force_delete');
    Route::resource('categories', CategoryController::class)->except('show');

    Route::resource('roles', RoleController::class)->except('show');

    Route::resource('permissions', PermissionController::class)->except('show');

    Route::resource('site-settings', SiteSettingController::class)->except(['index', 'destroy']);

});

Route::get('blogs-table', [BlogController::class,'indexDatatable'])->name('blogs.datatable');
Route::get('trashed-blogs', [BlogController::class, 'trashed'])->name('blog.trashed');
Route::post('blogs/{blog}/restore',[BlogController::class,'restore'])->name('blog.restore');
Route::post('blogs/{blog}/force-delete',[BlogController::class,'forceDelete'])->name('blog.force_delete');
Route::post('ck-images-store', [BlogController::class, 'CkImageStore'])->name('ck_image.store');
Route::resource('blogs', BlogController::class);
