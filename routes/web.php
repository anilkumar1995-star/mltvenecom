<?php

use App\Http\Controllers\Admin\MenuCountController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\admin\ProductLabelConntroller;
use App\Http\Controllers\Admin\ProductSpecification\GroupController;
use App\Http\Controllers\admin\ProductTagConntroller;
use App\Http\Controllers\admin\ProductTaxesConntroller;
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
use App\Http\Controllers\Auth\LoginController;


use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;


// FIX FOR LEGACY BOTBLE PACKAGES
Route::get('/admin/dashboard-index', [DashboardController::class, 'index'])->name('dashboard.index');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

// Customer Auth
// Route::get('/', [LoginController::class, 'home'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/password/reset', function () {return 'Password reset is currently disabled.';})->name('password.request');

// Placeholder routes to prevent rendering errors
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login']);


Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
// Route::get('/vendor/login', [VendorLoginController::class, 'showLoginForm'])->name('vendor.login');
// Route::post('/vendor/login', [VendorLoginController::class, 'login']);
// Route::post('/vendor/logout', [VendorLoginController::class, 'logout'])->name('vendor.logout');

Route::get('/admin/dashboard-redirect', [DashboardController::class, 'index'])->name('dashboard.index');

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth:customer,web')->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
});


Route::name('frontend.')->group(function () {
    
    // Vendor Dashboard
    Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
        Route::get('/dashboard', function () {
            return view('frontend.vendor.dashboard');
        })->name('dashboard');
    });

    // Home
    Route::get('/', [FrontendHomeController::class, 'index'])->name('home');
    // Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);


    // Products
    Route::get('/products', [FrontendProductController::class, 'index'])->name('products.index');
    Route::get('/products/{slug}', [FrontendProductController::class, 'show'])->name('products.show');
    Route::get('/categories/{slug}', [FrontendProductController::class, 'category'])->name('categories.show');
    Route::get('/brands/{slug}', [FrontendProductController::class, 'brand'])->name('brands.show');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

    // Account Deletion Confirmation
    Route::get('/account/delete/confirm/{token}', [App\Http\Controllers\Frontend\AccountDeletionController::class, 'confirm'])->name('account.deletion.confirm');

    // Customer Area (requires auth)
    // Customer Area (requires auth:customer or auth:web for vendors)
    Route::middleware('auth:customer,web')->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
        Route::get('/orders', [CustomerController::class, 'orders'])->name('orders');
        Route::get('/orders/{id}', [CustomerController::class, 'orderDetail'])->name('orders.detail');
        Route::get('/profile', [CustomerController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [CustomerController::class, 'updateProfile'])->name('profile.update');
        Route::get('/addresses', [CustomerController::class, 'addresses'])->name('addresses');
        Route::post('/addresses/store', [CustomerController::class, 'storeAddress'])->name('addresses.store');

        // Account Deletion Request
        Route::post('/account/delete', [App\Http\Controllers\Frontend\AccountDeletionController::class, 'store'])->name('account.deletion.request');
    });
});




// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin demo route
Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

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


    Route::group(['prefix' => 'category'], function () {
        Route::get('index', [CategoryController::class, 'index'])->name('category.Index');
        Route::get('create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/{category}/edit', [CategoryController::class, 'Edit'])->name('category.edit');
        Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/delete', [CategoryController::class, 'destroy'])->name('category.Delete');
        // Route::delete('/delete/{category}',[CategoryController::class,'approved'])->name('category.Delete');
    });

    Route::group(['prefix' => 'brand'], function () {
        Route::get('index', [BrandController::class, 'index'])->name('brand.Index');
        Route::get('create', [BrandController::class, 'create'])->name('brand.create');
        Route::post('store', [BrandController::class, 'store'])->name('brand.store');
        Route::get('/{brand}/edit', [BrandController::class, 'Edit'])->name('brand.edit');
        Route::put('/{brand}', [BrandController::class, 'update'])->name('brand.update');
        Route::post('/delete', [BrandController::class, 'destroy'])->name('brand.Delete');
        Route::post('bulk-delete', [BrandController::class, 'bulkDelete'])->name('brand.bulk-delete');
        Route::post('bulk-change', [BrandController::class, 'bulkChange'])->name('brand.bulk-change');
    });


    Route::group(['prefix' => 'group'], function () {
        Route::get('index', [GroupController::class, 'index'])->name('group.Index');
        Route::get('create', [GroupController::class, 'create'])->name('group.create');
        Route::post('store', [GroupController::class, 'store'])->name('group.store');
        Route::get('/{id}/edit', [GroupController::class, 'Edit'])->name('group.edit');
        Route::put('/{id}', [GroupController::class, 'update'])->name('group.update');
        Route::post('/delete', [GroupController::class, 'destroy'])->name('group.Delete');
        Route::post('bulk-delete', [GroupController::class, 'bulkDelete'])->name('group.bulk-delete');
    });

    Route::group(['prefix' => 'product-attributes'], function () {
        Route::get('index', [GroupController::class, 'productIndex'])->name('productattributes.Index');
        Route::get('create', [GroupController::class, 'productAttributeCreate'])->name('productAttribute.create');
        Route::post('store', [GroupController::class, 'productAttributeStore'])->name('productAttribute.store');
        Route::get('/{id}/edit', [GroupController::class, 'productAttributeEdit'])->name('productAttribute.edit');
        Route::put('/{id}', [GroupController::class, 'productAttributeupdate'])->name('productAttribute.update');
        Route::post('/delete', [GroupController::class, 'productAttributedestroy'])->name('productAttribute.Delete');
        Route::post('bulk-delete', [GroupController::class, 'productAttributebulkDelete'])->name('productAttribute.bulk-delete');
    });

    Route::group(['prefix' => 'product-table'], function () {
        Route::get('index', [GroupController::class, 'productTable'])->name('producttable.Index');
        Route::get('create', [GroupController::class, 'productTablecreate'])->name('producttable.create');
        Route::post('store', [GroupController::class, 'productTablestore'])->name('producttable.store');
        Route::get('/{id}/edit', [GroupController::class, 'productTableEdit'])->name('producttable.edit');
        Route::put('/{id}', [GroupController::class, 'productTableupdate'])->name('producttable.update');
        Route::post('/delete', [GroupController::class, 'productTabledestroy'])->name('producttable.Delete');
        Route::post('bulk-delete', [GroupController::class, 'productTablebulkDelete'])->name('producttable.bulk-delete');
    });


    Route::group(['prefix' => 'product-tags'], function () {
        Route::get('index', [ProductTagConntroller::class, 'Index'])->name('producttags.Index');
        Route::get('create', [ProductTagConntroller::class, 'create'])->name('producttags.create');
        Route::post('store', [ProductTagConntroller::class, 'store'])->name('producttags.store');
        Route::get('/{id}/edit', [ProductTagConntroller::class, 'Edit'])->name('producttags.edit');
        Route::put('/{id}', [ProductTagConntroller::class, 'update'])->name('producttags.update');
        Route::post('/delete', [ProductTagConntroller::class, 'destroy'])->name('producttags.Delete');
        Route::post('bulk-delete', [ProductTagConntroller::class, 'bulkDelete'])->name('producttags.bulk-delete');
    });

    // Route::group(['prefix' => 'product-taxes'], function () {
    //     Route::get('index', [ProductTaxesConntroller::class, 'Index'])->name('producttaxes.Index');
    //     Route::post('store', [ProductTaxesConntroller::class, 'productTablestore'])->name('producttaxes.store');
    //     Route::get('/{id}/edit', [ProductTaxesConntroller::class, 'productTableEdit'])->name('producttaxes.edit');
    //     Route::put('/{id}', [ProductTaxesConntroller::class, 'productTableupdate'])->name('producttaxes.update');
    //     Route::post('/delete', [ProductTaxesConntroller::class, 'productTabledestroy'])->name('producttaxes.Delete');
    //     Route::post('bulk-delete', [ProductTaxesConntroller::class, 'productTablebulkDelete'])->name('producttaxes.bulk-delete');
    // });


    Route::group(['prefix' => 'product-labels'], function () {
        Route::get('index', [ProductLabelConntroller::class, 'Index'])->name('productlables.Index');
        Route::get('create', [ProductLabelConntroller::class, 'create'])->name('productlables.create');
        Route::post('store', [ProductLabelConntroller::class, 'store'])->name('productlables.store');
        Route::get('/{id}/edit', [ProductLabelConntroller::class, 'Edit'])->name('productlables.edit');
        Route::put('/{id}', [ProductLabelConntroller::class, 'update'])->name('productlables.update');
        Route::post('/delete', [ProductLabelConntroller::class, 'destroy'])->name('productlables.Delete');
        Route::post('bulk-delete', [ProductLabelConntroller::class, 'bulkDelete'])->name('productlables.bulk-delete');
    });




  Route::group(['prefix' => 'marketplaces'], function() {
        Route::get('stores', [AdminStoreController::class,'index'])->name('marketplace.store.index');
        Route::get('reports', [ReportsController::class,'reports'])->name('marketplace.reports');
        Route::get('withdrawls', [WithdrawlsController::class,'withdrawls'])->name('marketplace.withdrawls');
        Route::get('vendors', [VendorController::class,'vendors'])->name('marketplace.vendors');
        Route::get('vendors/{id}', [VendorController::class, 'show'])->name('marketplace.vendors.show');
        Route::get('vendors/{id}/edit', [VendorController::class, 'edit'])->name('marketplace.vendors.edit');
        Route::put('vendors/{id}', [VendorController::class, 'update'])->name('marketplace.vendors.update');
        Route::delete('vendors/{id}', [VendorController::class, 'destroy'])->name('marketplace.vendors.destroy');
        Route::get('unverified-vendors', [VendorController::class,'unverifiedVendors'])->name('marketplace.unverified-vendors');
        Route::get('messages', [VendorController::class,'messages'])->name('marketplace.messages');
        Route::get('stores/create', [AdminStoreController::class,'create'])->name('marketplace.store.create');
        Route::post('stores', [AdminStoreController::class, 'store'])->name('marketplace.store.store');
        Route::get('stores/{store}', [AdminStoreController::class, 'show'])->name('marketplace.store.show');
        Route::get('stores/{store}/edit', [AdminStoreController::class, 'edit'])->name('marketplace.store.edit');
        Route::put('stores/{store}', [AdminStoreController::class, 'update'])->name('marketplace.store.update');

        Route::delete('stores/{store}', [AdminStoreController::class, 'destroy'])->name('marketplace.store.destroy');
        Route::post('stores/{store}/verify', [AdminStoreController::class, 'verify'])->name('marketplace.store.verify');
        Route::delete('messages/{id}', [VendorController::class, 'destroyMessage'])->name('marketplace.vendors.destroy-message');
        });

    Route::get('/menu-items-count', [MenuCountController::class, 'getCounts'])->name('menu-items-count');

});
