<?php

use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GlobalOptionController;
use App\Http\Controllers\Admin\MenuCountController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ProductAttributeSetController;
use App\Http\Controllers\Admin\ProductCollectionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\admin\ProductLabelConntroller;
use App\Http\Controllers\Admin\ProductSpecification\GroupController;
use App\Http\Controllers\admin\ProductTagConntroller;
use App\Http\Controllers\admin\ProductTaxesConntroller;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\StoreController as AdminStoreController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\WithdrawlsController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', [LoginController::class, 'home'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/password/reset', function () {return 'Password reset is currently disabled.';})->name('password.request');

// Vendor KYC Pending Page
Route::get('/vendor/kyc-pending', function (\Illuminate\Http\Request $request) {
    $user = \App\Models\User::find($request->query('user_id'));
    if (!$user || $user->role !== 'vendor') {
        return redirect()->route('login')->with('error', 'Invalid request.');
    }
    return view('auth.vendor-kyc-pending', [
        'kyc_url'    => $user->kyc_url,
        'kyc_status' => $user->kyc_status ?? 'pending',
        'user'       => $user,
    ]);
})->name('vendor.kyc-pending');

// Placeholder routes to prevent rendering errors
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
// Route::get('/vendor/login', [VendorLoginController::class, 'showLoginForm'])->name('vendor.login');
// Route::post('/vendor/login', [VendorLoginController::class, 'login']);
// Route::post('/vendor/logout', [VendorLoginController::class, 'logout'])->name('vendor.logout');

// Route::get('/admin/dashboard-redirect', [DashboardController::class, 'index'])->name('dashboard.index');

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

        // Vendor Products
        Route::get('/products', [App\Http\Controllers\Frontend\VendorProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [App\Http\Controllers\Frontend\VendorProductController::class, 'create'])->name('products.create');
        Route::post('/products', [App\Http\Controllers\Frontend\VendorProductController::class, 'store'])->name('products.store');
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
    Route::post('/cart/buy-now', [CartController::class, 'buyNow'])->name('cart.buyNow');
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
Route::get('/admin/dashboard', function () {
    return view('home');
})->name('admin.dashboard');

// Admin profile routes
// Route::middleware(['auth', 'role_id:1'])->prefix('admin')->name('admin.')->group(function () {
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Products CRUD
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    // static bulk-delete route before parameterized
    Route::get('/products/bulk-delete', function () {
        return redirect()->route('admin.products.index');
    });

    Route::get('/products/get-relations', [ProductController::class, 'getRelationProducts'])->name('products.get-relations');
    Route::post('getatablesData',[ProductController::class,'getSpecificationtablesData'])->name('getatablesData');
    Route::post('/get-attribute-values', [ProductController::class, 'getAttributeValues'])
    ->name('getAttributeValues');

    Route::get('/product-tags/all', [ProductController::class, 'getAllTags'])->name('product-tags.all');
    Route::post('/products/bulk-delete', [ProductController::class, 'bulkDelete'])->name('products.bulk_delete');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::put('/products/{product}/approve', [ProductController::class, 'approve'])->name('products.approve');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Product Prices
    Route::get('/product-prices', [App\Http\Controllers\Admin\ProductPriceController::class, 'index'])->name('product-prices.index');
    Route::post('/product-prices/update', [App\Http\Controllers\Admin\ProductPriceController::class, 'update'])->name('product-prices.update');

    // Product Inventory
    Route::get('/product-inventory', [App\Http\Controllers\Admin\ProductInventoryController::class, 'index'])->name('product-inventory.index');
    Route::post('/product-inventory/update', [App\Http\Controllers\Admin\ProductInventoryController::class, 'update'])->name('product-inventory.update');

    // Ecommerce Reports
    Route::get('/reports', [App\Http\Controllers\Admin\EcommerceReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/data', [App\Http\Controllers\Admin\EcommerceReportController::class, 'getRevenueChartData'])->name('reports.data');

    // Orders (Explicit Routes)
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [App\Http\Controllers\Admin\OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [App\Http\Controllers\Admin\OrderController::class, 'store'])->name('orders.store');
    Route::delete('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('orders.destroy');
    Route::post('/orders/bulk-delete', [App\Http\Controllers\Admin\OrderController::class, 'bulkDelete'])->name('orders.bulk_delete');
    Route::get('/orders/search-customer', [App\Http\Controllers\Admin\OrderController::class, 'searchCustomer'])->name('orders.search-customer');
    Route::get('/orders/search-product', [App\Http\Controllers\Admin\OrderController::class, 'searchProduct'])->name('orders.search-product');

    // Incomplete Orders
    Route::get('/incomplete-orders', [App\Http\Controllers\Admin\IncompleteOrderController::class, 'index'])->name('incomplete-orders.index');
    Route::delete('/incomplete-orders/{id}', [App\Http\Controllers\Admin\IncompleteOrderController::class, 'destroy'])->name('incomplete-orders.destroy');

    // Order Returns
    Route::get('/order-returns', [App\Http\Controllers\Admin\OrderReturnController::class, 'index'])->name('order-returns.index');
    Route::delete('/order-returns/{id}', [App\Http\Controllers\Admin\OrderReturnController::class, 'destroy'])->name('order-returns.destroy');

    // Shipments
    Route::get('/shipments', [App\Http\Controllers\Admin\ShipmentController::class, 'index'])->name('shipments.index');
    Route::delete('/shipments/{id}', [App\Http\Controllers\Admin\ShipmentController::class, 'destroy'])->name('shipments.destroy');

    // Invoices
    Route::get('/invoices', [App\Http\Controllers\Admin\InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/{id}', [App\Http\Controllers\Admin\InvoiceController::class, 'show'])->name('invoices.show');
    Route::delete('/invoices/{id}', [App\Http\Controllers\Admin\InvoiceController::class, 'destroy'])->name('invoices.destroy');

    // Reviews
    Route::get('/reviews', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/create', [App\Http\Controllers\Admin\ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [App\Http\Controllers\Admin\ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{id}/edit', [App\Http\Controllers\Admin\ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{id}', [App\Http\Controllers\Admin\ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::post('/reviews/bulk-delete', [App\Http\Controllers\Admin\ReviewController::class, 'bulkDelete'])->name('reviews.bulk-delete');

    // Flash Sales
    Route::get('/flash-sales', [App\Http\Controllers\Admin\FlashSaleController::class, 'index'])->name('flash-sales.index');
    Route::get('/flash-sales/create', [App\Http\Controllers\Admin\FlashSaleController::class, 'create'])->name('flash-sales.create');
    Route::post('/flash-sales', [App\Http\Controllers\Admin\FlashSaleController::class, 'store'])->name('flash-sales.store');
    Route::get('/flash-sales/{id}/edit', [App\Http\Controllers\Admin\FlashSaleController::class, 'edit'])->name('flash-sales.edit');
    Route::put('/flash-sales/{id}', [App\Http\Controllers\Admin\FlashSaleController::class, 'update'])->name('flash-sales.update');
    Route::delete('/flash-sales/{id}', [App\Http\Controllers\Admin\FlashSaleController::class, 'destroy'])->name('flash-sales.destroy');

    // Discounts
    Route::get('/discounts', [App\Http\Controllers\Admin\DiscountController::class, 'index'])->name('discounts.index');
    Route::get('/discounts/create', [App\Http\Controllers\Admin\DiscountController::class, 'create'])->name('discounts.create');
    Route::post('/discounts', [App\Http\Controllers\Admin\DiscountController::class, 'store'])->name('discounts.store');
    Route::get('/discounts/{id}/edit', [App\Http\Controllers\Admin\DiscountController::class, 'edit'])->name('discounts.edit');
    Route::put('/discounts/{id}', [App\Http\Controllers\Admin\DiscountController::class, 'update'])->name('discounts.update');
    Route::post('/discounts/bulk-delete', [App\Http\Controllers\Admin\DiscountController::class, 'bulkDelete'])->name('discounts.bulk_delete');
    Route::delete('/discounts/{id}', [App\Http\Controllers\Admin\DiscountController::class, 'destroy'])->name('discounts.destroy');






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

    // Global Options Routes
    Route::group(['prefix' => 'global-options'], function () {
        Route::get('/', [GlobalOptionController::class, 'index'])->name('global-options.index');
        Route::get('/create', [GlobalOptionController::class, 'create'])->name('global-options.create');
        Route::post('/store', [GlobalOptionController::class, 'store'])->name('global-options.store');
        Route::get('/{id}/edit', [GlobalOptionController::class, 'edit'])->name('global-options.edit');
        Route::put('/{id}', [GlobalOptionController::class, 'update'])->name('global-options.update');
        Route::post('/delete', [GlobalOptionController::class, 'destroy'])->name('global-options.delete');
        Route::post('/bulk-delete', [GlobalOptionController::class, 'bulkDelete'])->name('global-options.bulk-delete');
    });

    // Product Attribute Sets Routes
    Route::group(['prefix' => 'attribute-sets'], function () {
        Route::get('/', [ProductAttributeSetController::class, 'index'])->name('attribute-sets.index');
        Route::get('/create', [ProductAttributeSetController::class, 'create'])->name('attribute-sets.create');
        Route::post('/store', [ProductAttributeSetController::class, 'store'])->name('attribute-sets.store');
        Route::get('/{id}/edit', [ProductAttributeSetController::class, 'edit'])->name('attribute-sets.edit');
        Route::put('/{id}', [ProductAttributeSetController::class, 'update'])->name('attribute-sets.update');
        Route::post('/delete', [ProductAttributeSetController::class, 'destroy'])->name('attribute-sets.delete');
        Route::post('/bulk-delete', [ProductAttributeSetController::class, 'bulkDelete'])->name('attribute-sets.bulk-delete');
    });

    // Product Collections Routes
    Route::group(['prefix' => 'collections'], function () {
        Route::get('/', [ProductCollectionController::class, 'index'])->name('collections.index');
        Route::get('/create', [ProductCollectionController::class, 'create'])->name('collections.create');
        Route::post('/store', [ProductCollectionController::class, 'store'])->name('collections.store');
        Route::get('/{id}/edit', [ProductCollectionController::class, 'edit'])->name('collections.edit');
        Route::put('/{id}', [ProductCollectionController::class, 'update'])->name('collections.update');
        Route::post('/delete', [ProductCollectionController::class, 'destroy'])->name('collections.delete');
        Route::post('/bulk-delete', [ProductCollectionController::class, 'bulkDelete'])->name('collections.bulk-delete');
    });

    // Taxes Routes
    Route::group(['prefix' => 'taxes'], function () {
        Route::get('/', [TaxController::class, 'index'])->name('taxes.index');
        Route::get('/create', [TaxController::class, 'create'])->name('taxes.create');
        Route::post('/store', [TaxController::class, 'store'])->name('taxes.store');
        Route::get('/{id}/edit', [TaxController::class, 'edit'])->name('taxes.edit');
        Route::put('/{id}', [TaxController::class, 'update'])->name('taxes.update');
        Route::post('/delete', [TaxController::class, 'destroy'])->name('taxes.delete');
        Route::post('/bulk-delete', [TaxController::class, 'bulkDelete'])->name('taxes.bulk-delete');
    });

    // FAQs Routes
    Route::group(['prefix' => 'faqs'], function () {
        Route::get('/', [FaqController::class, 'index'])->name('faqs.index');
        Route::get('/create', [FaqController::class, 'create'])->name('faqs.create');
        Route::post('/store', [FaqController::class, 'store'])->name('faqs.store');
        Route::get('/{id}/edit', [FaqController::class, 'edit'])->name('faqs.edit');
        Route::put('/{id}', [FaqController::class, 'update'])->name('faqs.update');
        Route::post('/delete', [FaqController::class, 'destroy'])->name('faqs.delete');
        Route::post('/bulk-delete', [FaqController::class, 'bulkDelete'])->name('faqs.bulk-delete');
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
        Route::post('vendors/{id}/approve', [VendorController::class, 'approve'])->name('marketplace.vendors.approve');
        Route::post('vendors/{id}/check-kyc', [VendorController::class, 'checkKycStatus'])->name('marketplace.vendors.check-kyc');
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

         
          Route::get('pages', [AdminPageController::class, 'index'])->name('pages.index');
          Route::get('pages/create', [AdminPageController::class, 'create'])->name('pages.create');
          Route::post('pages', [AdminPageController::class, 'store'])->name('pages.store');
          Route::get('pages/{id}/edit', [AdminPageController::class, 'edit'])->name('pages.edit');
          Route::put('pages/{id}', [AdminPageController::class, 'update'])->name('pages.update');
          Route::delete('pages/{id}', [AdminPageController::class, 'destroy'])->name('pages.destroy');
          Route::get('/page/{id}', [AdminPageController::class, 'show'])->name('pages.show');


    Route::get('/menu-items-count', [MenuCountController::class, 'getCounts'])->name('menu-items-count');

});

