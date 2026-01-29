<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin demo route
Route::get('/admin', function () {
    return view('admin.dashboard');
});

// Admin profile routes
// Route::middleware(['auth', 'role_id:1'])->prefix('admin')->name('admin.')->group(function () {
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    // Product specification groups
    Route::prefix('product-spec')->name('spec.')->group(function () {
        // Specification attributes CRUD
        Route::get('/attributes', [App\Http\Controllers\Admin\SpecificationAttributeController::class, 'index'])->name('attributes.index');
        Route::get('/attributes/create', [App\Http\Controllers\Admin\SpecificationAttributeController::class, 'create'])->name('attributes.create');
        Route::post('/attributes', [App\Http\Controllers\Admin\SpecificationAttributeController::class, 'store'])->name('attributes.store');
        // static bulk-delete routes placed before parameterized ones
        Route::get('/attributes/bulk-delete', function () {
            return redirect()->route('admin.spec.attributes.index');
        });
        Route::post('/attributes/bulk-delete', [App\Http\Controllers\Admin\SpecificationAttributeController::class, 'bulkDelete'])->name('attributes.bulk_delete');
        Route::get('/attributes/{attribute}/edit', [App\Http\Controllers\Admin\SpecificationAttributeController::class, 'edit'])->name('attributes.edit');
        Route::put('/attributes/{attribute}', [App\Http\Controllers\Admin\SpecificationAttributeController::class, 'update'])->name('attributes.update');
        Route::delete('/attributes/{attribute}', [App\Http\Controllers\Admin\SpecificationAttributeController::class, 'destroy'])->name('attributes.destroy');

        // Specification tables CRUD
        Route::get('/tables', [App\Http\Controllers\Admin\SpecificationTableController::class, 'index'])->name('tables.index');
        Route::get('/tables/create', [App\Http\Controllers\Admin\SpecificationTableController::class, 'create'])->name('tables.create');
        Route::post('/tables', [App\Http\Controllers\Admin\SpecificationTableController::class, 'store'])->name('tables.store');
        // static bulk-delete before parameterized routes
        Route::get('/tables/bulk-delete', function () {
            return redirect()->route('admin.spec.tables.index');
        });
        Route::post('/tables/bulk-delete', [App\Http\Controllers\Admin\SpecificationTableController::class, 'bulkDelete'])->name('tables.bulk_delete');
        Route::get('/tables/{table}/edit', [App\Http\Controllers\Admin\SpecificationTableController::class, 'edit'])->name('tables.edit');
        Route::put('/tables/{table}', [App\Http\Controllers\Admin\SpecificationTableController::class, 'update'])->name('tables.update');
        Route::delete('/tables/{table}', [App\Http\Controllers\Admin\SpecificationTableController::class, 'destroy'])->name('tables.destroy');
        Route::get('/groups', [App\Http\Controllers\Admin\SpecificationGroupController::class, 'index'])->name('groups.index');
        Route::get('/groups/create', [App\Http\Controllers\Admin\SpecificationGroupController::class, 'create'])->name('groups.create');
        Route::post('/groups', [App\Http\Controllers\Admin\SpecificationGroupController::class, 'store'])->name('groups.store');
        // If someone visits the bulk-delete URL directly with GET, redirect back to index
        Route::get('/groups/bulk-delete', function () {
            return redirect()->route('admin.spec.groups.index');
        });
        Route::post('/groups/bulk-delete', [App\Http\Controllers\Admin\SpecificationGroupController::class, 'bulkDelete'])->name('groups.bulk_delete');

        Route::get('/groups/{group}/edit', [App\Http\Controllers\Admin\SpecificationGroupController::class, 'edit'])->name('groups.edit');
        Route::put('/groups/{group}', [App\Http\Controllers\Admin\SpecificationGroupController::class, 'update'])->name('groups.update');
        Route::delete('/groups/{group}', [App\Http\Controllers\Admin\SpecificationGroupController::class, 'destroy'])->name('groups.destroy');
    });

    // Products CRUD
    Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('products.store');
    // static bulk-delete route before parameterized
    Route::get('/products/bulk-delete', function () {
        return redirect()->route('admin.products.index');
    });
    Route::post('/products/bulk-delete', [App\Http\Controllers\Admin\ProductController::class, 'bulkDelete'])->name('products.bulk_delete');
    Route::get('/products/{product}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('products.destroy');


    Route::group(['prefix' => 'category'], function() {
        Route::get('index',[CategoryController::class,'index'])->name('category.Index');
        Route::get('create',[CategoryController::class,'create'])->name('category.create');
        Route::post('store',[CategoryController::class,'store'])->name('category.store');
        Route::get('/category/{category}/edit',[CategoryController::class,'Edit'])->name('category.edit');
        Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/delete/{category}',[CategoryController::class,'destroy'])->name('category.Delete');
    });

    Route::group(['prefix' => 'brand'], function() {
        Route::get('index',[BrandController::class,'index'])->name('brand.Index');
        Route::get('create',[BrandController::class,'create'])->name('brand.create');
        Route::post('store',[BrandController::class,'store'])->name('brand.store');
        Route::get('/brand/{brand}/edit',[BrandController::class,'Edit'])->name('brand.edit');
        Route::put('/brand/{brand}', [BrandController::class, 'update'])->name('brand.update');
        Route::delete('/delete/{brand}',[BrandController::class,'destroy'])->name('brand.Delete');
    });

});

Route::middleware(['auth', 'user_type:vendor'])
    ->prefix('vendor')
    ->name('vendor.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('vendor.dashboard');
        })->name('dashboard');

});
