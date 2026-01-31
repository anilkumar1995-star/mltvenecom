<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSpecification\GroupController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\SpecificationAttributeController;
use App\Http\Controllers\Admin\SpecificationGroupController;
use App\Http\Controllers\Admin\SpecificationTableController;
use App\Http\Controllers\Admin\StoreController as AdminStoreController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\WithdrawlsController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin demo route
Route::get('/admin', function () {
    return view('admin.dashboard');
});

// Admin profile routes
// Route::middleware(['auth', 'role_id:1'])->prefix('admin')->name('admin.')->group(function () {
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Product specification groups
    Route::prefix('product-spec')->name('spec.')->group(function () {
        // Specification attributes CRUD
        Route::get('/attributes', [SpecificationAttributeController::class, 'index'])->name('attributes.index');
        Route::get('/attributes/create', [SpecificationAttributeController::class, 'create'])->name('attributes.create');
        Route::post('/attributes', [SpecificationAttributeController::class, 'store'])->name('attributes.store');
        // static bulk-delete routes placed before parameterized ones
        Route::get('/attributes/bulk-delete', function () {
            return redirect()->route('admin.spec.attributes.index');
        });
        Route::post('/attributes/bulk-delete', [SpecificationAttributeController::class, 'bulkDelete'])->name('attributes.bulk_delete');
        Route::get('/attributes/{attribute}/edit', [SpecificationAttributeController::class, 'edit'])->name('attributes.edit');
        Route::put('/attributes/{attribute}', [SpecificationAttributeController::class, 'update'])->name('attributes.update');
        Route::delete('/attributes/{attribute}', [SpecificationAttributeController::class, 'destroy'])->name('attributes.destroy');

        // Specification tables CRUD
        Route::get('/tables', [SpecificationTableController::class, 'index'])->name('tables.index');
        Route::get('/tables/create', [SpecificationTableController::class, 'create'])->name('tables.create');
        Route::post('/tables', [SpecificationTableController::class, 'store'])->name('tables.store');
        // static bulk-delete before parameterized routes
        Route::get('/tables/bulk-delete', function () {
            return redirect()->route('admin.spec.tables.index');
        });
        Route::post('/tables/bulk-delete', [SpecificationTableController::class, 'bulkDelete'])->name('tables.bulk_delete');
        Route::get('/tables/{table}/edit', [SpecificationTableController::class, 'edit'])->name('tables.edit');
        Route::put('/tables/{table}', [SpecificationTableController::class, 'update'])->name('tables.update');
        Route::delete('/tables/{table}', [SpecificationTableController::class, 'destroy'])->name('tables.destroy');
        Route::get('/groups', [SpecificationGroupController::class, 'index'])->name('groups.index');
        Route::get('/groups/create', [SpecificationGroupController::class, 'create'])->name('groups.create');
        Route::post('/groups', [SpecificationGroupController::class, 'store'])->name('groups.store');
        // If someone visits the bulk-delete URL directly with GET, redirect back to index
        Route::get('/groups/bulk-delete', function () {
            return redirect()->route('admin.spec.groups.index');
        });
        Route::post('/groups/bulk-delete', [SpecificationGroupController::class, 'bulkDelete'])->name('groups.bulk_delete');

        Route::get('/groups/{group}/edit', [SpecificationGroupController::class, 'edit'])->name('groups.edit');
        Route::put('/groups/{group}', [SpecificationGroupController::class, 'update'])->name('groups.update');
        Route::delete('/groups/{group}', [SpecificationGroupController::class, 'destroy'])->name('groups.destroy');
    });

    // Products CRUD
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    // static bulk-delete route before parameterized
    Route::get('/products/bulk-delete', function () {
        return redirect()->route('admin.products.index');
    });
    Route::post('/products/bulk-delete', [ProductController::class, 'bulkDelete'])->name('products.bulk_delete');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


    Route::group(['prefix' => 'category'], function() {
        Route::get('index',[CategoryController::class,'index'])->name('category.Index');
        Route::get('create',[CategoryController::class,'create'])->name('category.create');
        Route::post('store',[CategoryController::class,'store'])->name('category.store');
        Route::get('/category/{category}/edit',[CategoryController::class,'Edit'])->name('category.edit');
        Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/delete',[CategoryController::class,'destroy'])->name('category.Delete');
        // Route::delete('/delete/{category}',[CategoryController::class,'approved'])->name('category.Delete');
    });

    Route::group(['prefix' => 'brand'], function() {
        Route::get('index',[BrandController::class,'index'])->name('brand.Index');
        Route::get('create',[BrandController::class,'create'])->name('brand.create');
        Route::post('store',[BrandController::class,'store'])->name('brand.store');
        Route::get('/{brand}/edit',[BrandController::class,'Edit'])->name('brand.edit');
        Route::put('/{brand}', [BrandController::class, 'update'])->name('brand.update');
        Route::post('/delete',[BrandController::class,'destroy'])->name('brand.Delete');
        Route::post('bulk-delete', [BrandController::class, 'bulkDelete'])->name('brand.bulk-delete');
        Route::post('bulk-change', [BrandController::class, 'bulkChange'])->name('brand.bulk-change');
    });

    Route::group(['prefix' => 'group'], function() {
        Route::get('index',[GroupController::class,'index'])->name('group.Index');
        Route::get('create',[GroupController::class,'create'])->name('group.create');
        // Route::post('store',[BrandController::class,'store'])->name('brand.store');
        // Route::get('/{brand}/edit',[BrandController::class,'Edit'])->name('brand.edit');
        // Route::put('/{brand}', [BrandController::class, 'update'])->name('brand.update');
        // Route::post('/delete',[BrandController::class,'destroy'])->name('brand.Delete');
        // Route::post('bulk-delete', [BrandController::class, 'bulkDelete'])->name('brand.bulk-delete');
        // Route::post('bulk-change', [BrandController::class, 'bulkChange'])->name('brand.bulk-change');
    });

    Route::group(['prefix' => 'product-attributes'], function() {
        Route::get('index',[GroupController::class,'productIndex'])->name('productattributes.Index');
        // Route::get('create',[BrandController::class,'create'])->name('brand.create');
        // Route::post('store',[BrandController::class,'store'])->name('brand.store');
        // Route::get('/{brand}/edit',[BrandController::class,'Edit'])->name('brand.edit');
        // Route::put('/{brand}', [BrandController::class, 'update'])->name('brand.update');
        // Route::post('/delete',[BrandController::class,'destroy'])->name('brand.Delete');
        // Route::post('bulk-delete', [BrandController::class, 'bulkDelete'])->name('brand.bulk-delete');
        // Route::post('bulk-change', [BrandController::class, 'bulkChange'])->name('brand.bulk-change');
    });


  Route::group(['prefix' => 'marketplaces'], function() {
        Route::get('stores', [AdminStoreController::class,'index'])->name('marketplace.store.index');
        Route::get('reports', [ReportsController::class,'reports'])->name('marketplace.reports');
        Route::get('withdrawls', [WithdrawlsController::class,'withdrawls'])->name('marketplace.withdrawls');
        Route::get('vendors', [VendorController::class,'vendors'])->name('marketplace.vendors');
        Route::get('unverified-vendors', [VendorController::class,'unverifiedVendors'])->name('marketplace.unverified-vendors');
        Route::get('messages', [VendorController::class,'messages'])->name('marketplace.messages');
        Route::get('stores/create', [AdminStoreController::class,'create'])->name('marketplace.store.create');
        Route::get('stores/{store}/edit', [AdminStoreController::class,'edit'])->name('marketplace.store.edit');
        Route::delete('stores/{store}', [AdminStoreController::class,'destroy'])->name('marketplace.store.destroy');
        });

});