<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\FooterSettingController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PaymentTransactionController;
use App\Http\Controllers\Admin\PaymentLogController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\EcommerceReportController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FlashSaleController;
use App\Http\Controllers\Admin\GlobalOptionController;
use App\Http\Controllers\Admin\IncompleteOrderController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\MenuCountController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderReturnController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductAttributeSetController;
use App\Http\Controllers\Admin\ProductCollectionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductInventoryController;
use App\Http\Controllers\Admin\ProductLabelConntroller;
use App\Http\Controllers\Admin\ProductPriceController;
use App\Http\Controllers\Admin\ProductSpecification\GroupController;
use App\Http\Controllers\Admin\ProductTagConntroller;
use App\Http\Controllers\Admin\ProductTaxesConntroller;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\Admin\SimpleSliderController;
use App\Http\Controllers\Admin\SimpleSliderItemController;
use App\Http\Controllers\Admin\StoreController as AdminStoreController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\WithdrawlsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\AccountDeletionController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CouponController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\VendorProductController;
use App\Http\Controllers\Frontend\VendorOrderController;
use App\Http\Controllers\Frontend\VendorOrderReturnController;
use App\Http\Controllers\Frontend\VendorDiscountController;
use App\Http\Controllers\Frontend\VendorWithdrawalController;
use App\Http\Controllers\Frontend\VendorReviewController;
use App\Http\Controllers\Frontend\VendorRevenueController;
use App\Http\Controllers\Frontend\VendorMessageController;
use App\Http\Controllers\Frontend\VendorSpecificationController;
use App\Http\Controllers\Frontend\VendorKycController;
use App\Http\Controllers\Frontend\VendorSettingsController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\PublicEcommerceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PublicAjaxController;
use App\Models\Order;
use App\Models\Review;
use App\Models\Store;
use App\Http\Controllers\Admin\ContactController;

Route::get('/ajax-search', [PublicAjaxController::class, 'ajaxSearchProducts'])->name('public.ajax.search');


// Route::get('/', [LoginController::class, 'home'])->name('home');
Route::get('/login', [LoginController::class , 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class , 'login'])->name('login.post');

Route::get('/register', [RegisterController::class , 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class , 'register']);
Route::match (['get', 'post'], '/logout', [LoginController::class , 'logout'])->name('logout');
// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Vendor KYC Pending Page
Route::get('/v/kyc-pending', function (\Illuminate\Http\Request $request) {
    $customer = \App\Models\Customer::find($request->query('user_id'));
    if (!$customer || !$customer->is_vendor) {
        return redirect()->route('login')->with('error', 'Invalid request.');
    }
    return view('auth.vendor-kyc-pending', [
    'kyc_url' => $customer->kyc_url,
    'kyc_status' => $customer->kyc_status ?? 'pending',
    'user' => $customer,
    ]);
})->name('vendor.kyc-pending');

// Placeholder routes to prevent rendering errors
Route::get('/admin/login', [LoginController::class , 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class , 'login'])->name('admin.login.post');
Route::post('/admin/logout', [LoginController::class , 'logout'])->name('admin.logout');
// Route::get('/vendor/login', [VendorLoginController::class, 'showLoginForm'])->name('vendor.login');
// Route::post('/vendor/login', [VendorLoginController::class, 'login']);
// Route::post('/vendor/logout', [VendorLoginController::class, 'logout'])->name('vendor.logout');

// Route::get('/admin/dashboard-redirect', [DashboardController::class, 'index'])->name('dashboard.index');

/* |-------------------------------------------------------------------------- | FRONTEND ROUTES |-------------------------------------------------------------------------- */

Route::middleware('auth:customer,web')->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class , 'dashboard'])->name('dashboard');
    Route::get('/become-vendor', [CustomerController::class , 'becomeVendor'])->name('become-vendor');
    Route::post('/become-vendor', [CustomerController::class , 'processBecomeVendor'])->name('become-vendor.post');
});

Route::name('frontend.')->group(function () {

    Route::middleware(['auth:customer', 'role:vendor'])->prefix('v')->name('vendor.')->group(function () {
            Route::get('product-tags/all', [VendorProductController::class , 'getAllTags'])->name('product-tags.all');
            Route::get('/dashboard', [VendorProductController::class , 'dashboard'])->name('dashboard');


            // Vendor Products
            Route::get('/products', [VendorProductController::class , 'index'])->name('products.index');
            Route::get('/products/create', [VendorProductController::class , 'create'])->name('products.create');
            Route::post('/products', [VendorProductController::class , 'store'])->name('products.store');
            Route::get('/products/{product}/edit', [VendorProductController::class , 'edit'])->name('products.edit');
            Route::put('/products/{product}', [VendorProductController::class , 'update'])->name('products.update');
            Route::delete('/products/{product}', [VendorProductController::class , 'destroy'])->name('products.destroy');
            Route::post('/products/bulk-delete', [VendorProductController::class , 'bulkDelete'])->name('products.bulk-delete');

            // Helper routes for product creation (mirrored from admin)
            Route::get('/products/get-relations', [VendorProductController::class , 'getRelationProducts'])->name('products.get-relations');
            Route::get('/products/get-attribute-values', [VendorProductController::class, 'getAttributeValues'])->name('products.get-attribute-values');
            Route::get('/products/get-global-option/{id?}', [VendorProductController::class, 'getGlobalOption'])->name('products.get-global-option');
            Route::post('/getatablesData', [VendorProductController::class , 'getSpecificationtablesData'])->name('getatablesData');

            // Vendor Orders
            Route::get('/orders', [VendorOrderController::class , 'index'])->name('orders.index');
            Route::get('/orders/{order}', [VendorOrderController::class , 'show'])->name('orders.show');
            Route::put('/orders/{order}', [VendorOrderController::class , 'update'])->name('orders.update');
            Route::post('/orders/bulk-delete', [VendorOrderController::class , 'bulkDelete'])->name('orders.bulk-delete');

            // Vendor Returns
            Route::get('/order-returns', [VendorOrderReturnController::class , 'index'])->name('order-returns.index');
            Route::get('/order-returns/{orderReturn}', [VendorOrderReturnController::class , 'show'])->name('order-returns.show');
            Route::put('/order-returns/{orderReturn}', [VendorOrderReturnController::class , 'update'])->name('order-returns.update');

            // Vendor Discounts
            Route::get('/discounts', [VendorDiscountController::class , 'index'])->name('discounts.index');
            Route::get('/discounts/create', [VendorDiscountController::class , 'create'])->name('discounts.create');
            Route::post('/discounts', [VendorDiscountController::class , 'store'])->name('discounts.store');
            Route::get('/discounts/{discount}/edit', [VendorDiscountController::class , 'edit'])->name('discounts.edit');
            Route::put('/discounts/{discount}', [VendorDiscountController::class , 'update'])->name('discounts.update');
            Route::delete('/discounts/{discount}', [VendorDiscountController::class , 'destroy'])->name('discounts.destroy');
            Route::post('/discounts/bulk-delete', [VendorDiscountController::class , 'bulkDelete'])->name('discounts.bulk-delete');

            // Vendor Withdrawals
            Route::get('/withdrawals', [VendorWithdrawalController::class , 'index'])->name('withdrawals.index');
            Route::get('/withdrawals/create', [VendorWithdrawalController::class , 'create'])->name('withdrawals.create');
            Route::post('/withdrawals', [VendorWithdrawalController::class , 'store'])->name('withdrawals.store');

            // Vendor Reviews
            Route::get('/reviews', [VendorReviewController::class , 'index'])->name('reviews.index');
            Route::get('/reviews/{review}', [VendorReviewController::class , 'show'])->name('reviews.show');
            Route::post('/reviews/bulk-delete', [VendorReviewController::class , 'bulkDelete'])->name('reviews.bulk-delete');

            // Vendor Revenues
            Route::get('/revenues', [VendorRevenueController::class , 'index'])->name('revenues.index');

            // Vendor Messages
            Route::get('/messages', [VendorMessageController::class , 'index'])->name('messages.index');
            Route::get('/messages/{message}', [VendorMessageController::class , 'show'])->name('messages.show');
            Route::delete('/messages/{message}', [VendorMessageController::class , 'destroy'])->name('messages.destroy');
            Route::post('/messages/bulk-delete', [VendorMessageController::class , 'bulkDelete'])->name('messages.bulk-delete');

            // Vendor Specifications
            Route::get('/specifications/groups', [VendorSpecificationController::class , 'groupsIndex'])->name('specifications.groups.index');
            Route::get('/specifications/tables', [VendorSpecificationController::class , 'tablesIndex'])->name('specifications.tables.index');

            // Vendor Settings
            Route::get('/settings', [VendorSettingsController::class , 'index'])->name('settings.index');
            Route::put('/settings', [VendorSettingsController::class , 'update'])->name('settings.update');

            // Vendor KYC Verification
            Route::get('/kyc', [VendorKycController::class , 'index'])->name('kyc.index');
            Route::post('/kyc', [VendorKycController::class , 'store'])->name('kyc.store');
        }
        );

        // Home
        Route::get('/', [FrontendHomeController::class , 'index'])->name('home');
        // Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
    
        // Products
        Route::get('/products', [FrontendProductController::class , 'index'])->name('products.index');
        Route::get('/products/{slug}', [FrontendProductController::class , 'show'])->name('products.show');
        Route::get('/categories/{slug}', [FrontendProductController::class , 'category'])->name('categories.show');
        Route::get('/brands/{slug}', [FrontendProductController::class , 'brand'])->name('brands.show');

        // Categories
        Route::get('/categories', [CategoryController::class , 'index'])->name('categories.index');

        // Brands
        Route::get('/brands', [BrandController::class , 'index'])->name('brands.index');

        // Coupons
        Route::get('/coupons', [CouponController::class , 'index'])->name('coupons.index');

        // FAQs
        Route::get('/faqs', [FaqController::class , 'index'])->name('faqs.index');

        // Blog
        Route::get('/blog', [BlogController::class , 'index'])->name('blog.index');
        Route::get('/blog/{slug}', [BlogController::class , 'show'])->name('blog.show');

        // Contact
        Route::get('/contact', [ContactController::class , 'index'])->name('contact.index');
        Route::post('/contact/send', [ContactController::class , 'send'])->name('contact.send');

        // Stores
        Route::get('/stores', [StoreController::class , 'index'])->name('stores.index');
        Route::get('/stores/{slug}', [StoreController::class , 'show'])->name('stores.show');
        Route::post('/stores/{slug}/message', [StoreController::class , 'storeMessage'])->name('stores.message');

        // Cart
        Route::get('/cart', [CartController::class , 'index'])->name('cart.index');
        Route::post('/cart/add', [CartController::class , 'add'])->name('cart.add');
        Route::post('/cart/buy-now', [CartController::class , 'buyNow'])->name('cart.buyNow');
        Route::post('/cart/update', [CartController::class , 'update'])->name('cart.update');
        Route::delete('/cart/remove/{id}', [CartController::class , 'remove'])->name('cart.remove');

        // Wishlist
        Route::post('/wishlist/toggle', [WishlistController::class , 'toggle'])->name('wishlist.toggle');
        Route::get('/wishlist', [WishlistController::class , 'index'])->name('wishlist.index');

        // Reviews
        Route::post('/reviews', [ReviewController::class , 'store'])->name('reviews.store');
        Route::get('/reviews/ajax/{productId}', [ReviewController::class , 'ajaxReviews'])->name('reviews.ajax');

        // Checkout
        Route::get('/checkout', [CheckoutController::class , 'index'])->name('checkout.index');
        Route::post('/checkout/apply-coupon', [CheckoutController::class , 'applyCoupon'])->name('checkout.apply-coupon');
        Route::get('/checkout/remove-coupon', [CheckoutController::class , 'removeCoupon'])->name('checkout.remove-coupon');
        Route::post('/checkout/process', [CheckoutController::class , 'process'])->name('checkout.process');
        Route::get('/checkout/success', [CheckoutController::class , 'success'])->name('checkout.success');
        
        // Flash Sale
        Route::get('/flash-sale/{id}', [FlashSaleController::class, 'show'])->name('flash-sale.show');

        // Order Tracking
        Route::get('/orders/tracking', [PublicEcommerceController::class, 'orderTracking'])->name('orders.tracking');
        Route::post('/orders/tracking', [PublicEcommerceController::class, 'trackOrder'])->name('orders.tracking.post');

        // Our Story
        Route::get('/our-story', [PublicEcommerceController::class, 'ourStory'])->name('our-story');

        // Shipping
        Route::get('/shipping', [PublicEcommerceController::class, 'shipping'])->name('shipping');

        // Careers
        Route::get('/careers', [PublicEcommerceController::class, 'careers'])->name('careers');

        // Cookie Policy
        Route::get('/cookie-policy', [PublicEcommerceController::class, 'cookiePolicy'])->name('cookie-policy');

        // Account Deletion Confirmation
        Route::get('/account/delete/confirm/{token}', [AccountDeletionController::class , 'confirm'])->name('account.deletion.confirm');

        // Customer Area (requires auth)
        // Customer Area (requires auth:customer or auth:web for vendors)
        Route::middleware('auth:customer,web')->prefix('customer')->name('customer.')->group(function () {
            Route::get('/dashboard', [CustomerController::class , 'dashboard'])->name('dashboard');
            Route::get('/orders', [CustomerController::class , 'orders'])->name('orders');
            Route::get('/orders/{id}', [CustomerController::class , 'orderDetail'])->name('orders.detail');
            Route::get('/profile', [CustomerController::class , 'profile'])->name('profile');
            Route::post('/profile/update', [CustomerController::class , 'updateProfile'])->name('profile.update');
            Route::post('/profile/change-password', [CustomerController::class , 'updatePassword'])->name('profile.change-password');
            Route::get('/addresses', [CustomerController::class , 'addresses'])->name('addresses');
            Route::post('/addresses/store', [CustomerController::class , 'storeAddress'])->name('addresses.store');
            Route::put('/addresses/{id}/update', [CustomerController::class , 'updateAddress'])->name('addresses.update');
            Route::delete('/addresses/{id}/delete', [CustomerController::class , 'deleteAddress'])->name('addresses.delete');

            Route::get('/invoices', [CustomerController::class , 'invoices'])->name('invoices');
            Route::get('/invoices/{id}', [CustomerController::class , 'invoiceDetail'])->name('invoices.show');
            Route::get('/reviews', [CustomerController::class , 'reviews'])->name('reviews');
            Route::get('/downloads', [CustomerController::class , 'downloads'])->name('downloads');
            Route::get('/returns', [CustomerController::class , 'returns'])->name('returns');

            // Account Deletion Request
            Route::post('/account/delete', [AccountDeletionController::class , 'store'])->name('account.deletion.request');

            // Become Vendor
            Route::get('/become-vendor', [CustomerController::class , 'becomeVendor'])->name('become-vendor');
            Route::post('/become-vendor', [CustomerController::class , 'processBecomeVendor'])->name('become-vendor.post');
        }
        );
    });


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/dashboard-home', [HomeController::class , 'index'])->name('home');
Route::get('/page/{id}', [AdminPageController::class , 'show'])->name('pages.show');


// Admin profile routes
// Route::middleware(['auth', 'role_id:1'])->prefix('admin')->name('admin.')->group(function () {
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        }
        );
        Route::get('/dashboard', [AdminDashboardController::class , 'index'])->name('dashboard');
        Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class , 'update'])->name('profile.update');

        // Products CRUD
        Route::get('/products', [ProductController::class , 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class , 'create'])->name('products.create');
        Route::post('/products', [ProductController::class , 'store'])->name('products.store');
        // static bulk-delete route before parameterized
        Route::get('/products/bulk-delete', function () {
            return redirect()->route('admin.products.index');
        }
        );

        Route::get('/products/get-relations', [ProductController::class , 'getRelationProducts'])->name('products.get-relations');
        Route::post('getatablesData', [ProductController::class , 'getSpecificationtablesData'])->name('getatablesData');
        Route::post('/get-attribute-values', [ProductController::class , 'getAttributeValues'])
            ->name('getAttributeValues');

        Route::get('/product-tags/all', [ProductController::class , 'getAllTags'])->name('product-tags.all');
        Route::post('/products/bulk-delete', [ProductController::class , 'bulkDelete'])->name('products.bulk-delete');
        Route::get('/products/{product}/show', [ProductController::class , 'show'])->name('products.show');
        Route::get('/products/{product}/edit', [ProductController::class , 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class , 'update'])->name('products.update');
        Route::put('/products/{product}/approve', [ProductController::class , 'approve'])->name('products.approve');
        Route::delete('/products/{product}', [ProductController::class , 'destroy'])->name('products.destroy');

        // Product Prices
        Route::get('/product-prices', [ProductPriceController::class , 'index'])->name('product-prices.index');
        Route::post('/product-prices/bulk-delete', [ProductPriceController::class , 'bulkDelete'])->name('product-prices.bulk-delete');
        Route::post('/product-prices/update', [ProductPriceController::class , 'update'])->name('product-prices.update');
        Route::delete('/product-prices/{id}', [ProductPriceController::class , 'destroy'])->name('product-prices.destroy');

        // Product Inventory
        Route::get('/product-inventory', [ProductInventoryController::class , 'index'])->name('product-inventory.index');
        Route::post('/product-inventory/bulk-delete', [ProductInventoryController::class , 'bulkDelete'])->name('product-inventory.bulk-delete');
        Route::post('/product-inventory/update', [ProductInventoryController::class , 'update'])->name('product-inventory.update');
        Route::delete('/product-inventory/{id}', [ProductInventoryController::class , 'destroy'])->name('product-inventory.destroy');

        // Ecommerce Reports
        Route::get('/reports', [EcommerceReportController::class , 'index'])->name('reports.index');
        Route::get('/reports/data', [EcommerceReportController::class , 'getRevenueChartData'])->name('reports.data');

        // Orders (Explicit Routes)
        Route::get('/orders', [OrderController::class , 'index'])->name('orders.index');
        Route::get('/orders/create', [OrderController::class , 'create'])->name('orders.create');
        Route::post('/orders', [OrderController::class , 'store'])->name('orders.store');
        Route::get('/orders/{id}/edit', [OrderController::class , 'edit'])->name('orders.edit');
        Route::put('/orders/{id}', [OrderController::class , 'update'])->name('orders.update');
        Route::delete('/orders/{id}', [OrderController::class , 'destroy'])->name('orders.destroy');
        Route::post('/orders/bulk-delete', [OrderController::class , 'bulkDelete'])->name('orders.bulk-delete');
        Route::get('/orders/search-customer', [OrderController::class , 'searchCustomer'])->name('orders.search-customer');
        Route::get('/orders/search-product', [OrderController::class , 'searchProduct'])->name('orders.search-product');

        // Incomplete Orders
        Route::get('/incomplete-orders', [IncompleteOrderController::class , 'index'])->name('incomplete-orders.index');
        Route::get('/incomplete-orders/{id}/edit', [OrderController::class , 'edit'])->name('incomplete-orders.edit');
        Route::post('/incomplete-orders/bulk-delete', [IncompleteOrderController::class , 'bulkDelete'])->name('incomplete-orders.bulk-delete');
        Route::delete('/incomplete-orders/{id}', [IncompleteOrderController::class , 'destroy'])->name('incomplete-orders.destroy');

        // Order Returns
        Route::get('/order-returns', [OrderReturnController::class , 'index'])->name('order-returns.index');
        Route::post('/order-returns/bulk-delete', [OrderReturnController::class , 'bulkDelete'])->name('order-returns.bulk-delete');
        Route::get('/order-returns/export', [OrderReturnController::class , 'export'])->name('order-returns.export');
        Route::delete('/order-returns/{id}', [OrderReturnController::class , 'destroy'])->name('order-returns.destroy');

        // Shipments
        Route::get('shipments', [ShipmentController::class , 'index'])->name('shipments.index');
        Route::delete('shipments/{id}', [ShipmentController::class , 'destroy'])->name('shipments.destroy');
        Route::post('shipments/bulk-delete', [ShipmentController::class , 'bulkDelete'])->name('shipments.bulk-delete');
        Route::get('shipments/export', [ShipmentController::class , 'export'])->name('shipments.export');
        Route::get('shipments/{id}/edit', [ShipmentController::class , 'edit'])->name('shipments.edit');
        Route::put('shipments/{id}', [ShipmentController::class , 'update'])->name('shipments.update');

        // Invoices
        Route::get('/invoices', [InvoiceController::class , 'index'])->name('invoices.index');
        Route::post('/invoices/generate-invoices', [InvoiceController::class , 'generate'])->name('invoices.generate');
        Route::post('/invoices/bulk-delete', [InvoiceController::class , 'bulkDelete'])->name('invoices.bulk-delete');
        Route::get('/invoices/{id}', [InvoiceController::class , 'show'])->name('invoices.show');
        Route::delete('/invoices/{id}', [InvoiceController::class , 'destroy'])->name('invoices.destroy');

        // Reviews
        Route::get('/reviews', [ReviewController::class , 'index'])->name('reviews.index');
        Route::get('/reviews/create', [ReviewController::class , 'create'])->name('reviews.create');
        Route::post('/reviews', [ReviewController::class , 'store'])->name('reviews.store');
        Route::get('/reviews/{id}/show', [ReviewController::class , 'show'])->name('reviews.show');
        Route::post('/reviews/{id}/reply', [ReviewController::class , 'reply'])->name('reviews.reply');
        Route::get('/reviews/{id}/edit', [ReviewController::class , 'edit'])->name('reviews.edit');
        Route::put('/reviews/{id}', [ReviewController::class , 'update'])->name('reviews.update');
        Route::delete('/reviews/{id}', [ReviewController::class , 'destroy'])->name('reviews.destroy');
        Route::post('/reviews/bulk-delete', [ReviewController::class , 'bulkDelete'])->name('reviews.bulk-delete');

        // Flash Sales
        Route::get('/flash-sales', [FlashSaleController::class , 'index'])->name('flash-sales.index');
        Route::get('/flash-sales/create', [FlashSaleController::class , 'create'])->name('flash-sales.create');
        Route::post('/flash-sales', [FlashSaleController::class , 'store'])->name('flash-sales.store');
        Route::get('/flash-sales/{id}/edit', [FlashSaleController::class , 'edit'])->name('flash-sales.edit');
        Route::put('/flash-sales/{id}', [FlashSaleController::class , 'update'])->name('flash-sales.update');
        Route::delete('/flash-sales/{id}', [FlashSaleController::class , 'destroy'])->name('flash-sales.destroy');
        Route::post('/flash-sales/bulk-delete', [FlashSaleController::class , 'bulkDelete'])->name('flash-sales.bulk-delete');

        // Discounts
        Route::get('/discounts', [DiscountController::class , 'index'])->name('discounts.index');
        Route::get('/discounts/create', [DiscountController::class , 'create'])->name('discounts.create');
        Route::post('/discounts', [DiscountController::class , 'store'])->name('discounts.store');
        Route::get('/discounts/{id}/edit', [DiscountController::class , 'edit'])->name('discounts.edit');
        Route::put('/discounts/{id}', [DiscountController::class , 'update'])->name('discounts.update');
        Route::post('/discounts/bulk-delete', [DiscountController::class , 'bulkDelete'])->name('discounts.bulk-delete');
        Route::delete('/discounts/{id}', [DiscountController::class , 'destroy'])->name('discounts.destroy');






        Route::group(['prefix' => 'category'], function () {
            Route::get('index', [CategoryController::class , 'index'])->name('category.Index');
            Route::get('create', [CategoryController::class , 'create'])->name('category.create');
            Route::post('store', [CategoryController::class , 'store'])->name('category.store');
            Route::get('/bulk-delete', function () {
                    return redirect()->route('admin.category.Index');
                }
                );
                Route::post('/bulk-delete', [CategoryController::class , 'bulkDelete'])->name('category.bulk-delete');
                Route::get('/{category}/edit', [CategoryController::class , 'Edit'])->name('category.edit');
                Route::put('/{category}', [CategoryController::class , 'update'])->name('category.update');
                Route::delete('/{id}', [CategoryController::class , 'destroy'])->name('category.destroy');
                // Legacy post delete
                Route::post('/delete', [CategoryController::class , 'destroy'])->name('category.Delete');
            // Route::delete('/delete/{category}',[CategoryController::class,'approved'])->name('category.Delete');
            }
            );

            Route::group(['prefix' => 'brand'], function () {
            Route::get('index', [BrandController::class , 'index'])->name('brand.Index');
            Route::get('create', [BrandController::class , 'create'])->name('brand.create');
            Route::post('store', [BrandController::class , 'store'])->name('brand.store');
            Route::get('/{brand}/edit', [BrandController::class , 'Edit'])->name('brand.edit');
            Route::put('/{brand}', [BrandController::class , 'update'])->name('brand.update');
            Route::post('/delete', [BrandController::class , 'destroy'])->name('brand.Delete');
            Route::post('bulk-delete', [BrandController::class , 'bulkDelete'])->name('brand.bulk-delete');
            Route::post('bulk-change', [BrandController::class , 'bulkChange'])->name('brand.bulk-change');
        }
        );

        Route::group(['prefix' => 'group'], function () {
            Route::get('index', [GroupController::class , 'index'])->name('group.Index');
            Route::get('create', [GroupController::class , 'create'])->name('group.create');
            Route::post('store', [GroupController::class , 'store'])->name('group.store');
            Route::get('/{id}/edit', [GroupController::class , 'Edit'])->name('group.edit');
            Route::put('/{id}', [GroupController::class , 'update'])->name('group.update');
            Route::delete('/delete', [GroupController::class , 'destroy'])->name('group.Delete');
            Route::post('bulk-delete', [GroupController::class , 'bulkDelete'])->name('group.bulk-delete');
        }
        );

        Route::group(['prefix' => 'product-attributes'], function () {
            // attributes -> specAttributes renamed in view/controller
            Route::get('index', [GroupController::class , 'productIndex'])->name('productattributes.Index');
            Route::get('create', [GroupController::class , 'productAttributeCreate'])->name('productAttribute.create');
            Route::post('store', [GroupController::class , 'productAttributeStore'])->name('productAttribute.store');
            Route::get('/{id}/edit', [GroupController::class , 'productAttributeEdit'])->name('productAttribute.edit');
            Route::put('/{id}', [GroupController::class , 'productAttributeupdate'])->name('productAttribute.update');
            Route::delete('/delete', [GroupController::class , 'productAttributedestroy'])->name('productAttribute.Delete');
            Route::post('bulk-delete', [GroupController::class , 'productAttributebulkDelete'])->name('productAttribute.bulk-delete');
        }
        );

        Route::group(['prefix' => 'product-table'], function () {
            Route::get('index', [GroupController::class , 'productTable'])->name('producttable.Index');
            Route::get('create', [GroupController::class , 'productTablecreate'])->name('producttable.create');
            Route::post('store', [GroupController::class , 'productTablestore'])->name('producttable.store');
            Route::get('/{id}/edit', [GroupController::class , 'productTableEdit'])->name('producttable.edit');
            Route::put('/{id}', [GroupController::class , 'productTableupdate'])->name('producttable.update');
            Route::delete('/delete', [GroupController::class , 'productTabledestroy'])->name('producttable.Delete');
            Route::post('bulk-delete', [GroupController::class , 'productTablebulkDelete'])->name('producttable.bulk-delete');
        }
        );

        // Product Tags
        Route::group(['prefix' => 'product-tags'], function () {
            Route::get('index', [ProductTagConntroller::class , 'Index'])->name('producttags.Index');
            Route::get('bulk-delete', function () {
                    return redirect()->route('admin.producttags.Index');
                }
                );
                Route::post('bulk-delete', [ProductTagConntroller::class , 'bulkDelete'])->name('producttags.bulk-delete');
                Route::get('create', [ProductTagConntroller::class , 'create'])->name('producttags.create');
                Route::post('store', [ProductTagConntroller::class , 'store'])->name('producttags.store');
                Route::get('/{id}/edit', [ProductTagConntroller::class , 'Edit'])->name('producttags.edit');
                Route::put('/{id}', [ProductTagConntroller::class , 'update'])->name('producttags.update');
                Route::delete('/{id}', [ProductTagConntroller::class , 'destroy'])->name('producttags.destroy'); // Standardized RESTful route
                // Backward compatibility if needed
                Route::post('/delete', [ProductTagConntroller::class , 'destroy'])->name('producttags.Delete');
            }
            );

            // Route::group(['prefix' => 'product-taxes'], function () {
            //     Route::get('index', [ProductTaxesConntroller::class, 'Index'])->name('producttaxes.Index');
            //     Route::post('store', [ProductTaxesConntroller::class, 'productTablestore'])->name('producttaxes.store');
            //     Route::get('/{id}/edit', [ProductTaxesConntroller::class, 'productTableEdit'])->name('producttaxes.edit');
            //     Route::put('/{id}', [ProductTaxesConntroller::class, 'productTableupdate'])->name('producttaxes.update');
            //     Route::post('/delete', [ProductTaxesConntroller::class, 'productTabledestroy'])->name('producttaxes.Delete');
            //     Route::post('bulk-delete', [ProductTaxesConntroller::class, 'productTablebulkDelete'])->name('producttaxes.bulk-delete');
            // });
        

            Route::group(['prefix' => 'product-labels'], function () {
            Route::get('index', [ProductLabelConntroller::class , 'Index'])->name('productlables.Index');
            Route::get('create', [ProductLabelConntroller::class , 'create'])->name('productlables.create');
            Route::post('store', [ProductLabelConntroller::class , 'store'])->name('productlables.store');
            Route::get('/{id}/edit', [ProductLabelConntroller::class , 'Edit'])->name('productlables.edit');
            Route::put('/{id}', [ProductLabelConntroller::class , 'update'])->name('productlables.update');
            Route::post('/delete', [ProductLabelConntroller::class , 'destroy'])->name('productlables.Delete');
            Route::post('bulk-delete', [ProductLabelConntroller::class , 'bulkDelete'])->name('productlables.bulk-delete');
        }
        );

        // Global Options Routes
        Route::group(['prefix' => 'global-options'], function () {
            Route::get('/', [GlobalOptionController::class , 'index'])->name('global-options.index');
            Route::get('/create', [GlobalOptionController::class , 'create'])->name('global-options.create');
            Route::post('/store', [GlobalOptionController::class , 'store'])->name('global-options.store');
            Route::get('/{id}/edit', [GlobalOptionController::class , 'edit'])->name('global-options.edit');
            Route::put('/{id}', [GlobalOptionController::class , 'update'])->name('global-options.update');
            Route::post('/delete', [GlobalOptionController::class , 'destroy'])->name('global-options.delete');
            Route::post('/bulk-delete', [GlobalOptionController::class , 'bulkDelete'])->name('global-options.bulk-delete');
        }
        );

        // Product Attribute Sets Routes
        Route::group(['prefix' => 'attribute-sets'], function () {
            Route::get('/', [ProductAttributeSetController::class , 'index'])->name('attribute-sets.index');
            Route::get('/create', [ProductAttributeSetController::class , 'create'])->name('attribute-sets.create');
            Route::post('/store', [ProductAttributeSetController::class , 'store'])->name('attribute-sets.store');
            Route::get('/{id}/edit', [ProductAttributeSetController::class , 'edit'])->name('attribute-sets.edit');
            Route::put('/{id}', [ProductAttributeSetController::class , 'update'])->name('attribute-sets.update');
            Route::post('/delete', [ProductAttributeSetController::class , 'destroy'])->name('attribute-sets.delete');
            Route::post('/bulk-delete', [ProductAttributeSetController::class , 'bulkDelete'])->name('attribute-sets.bulk-delete');
        }
        );

        // Product Collections Routes
        Route::group(['prefix' => 'collections'], function () {
            Route::get('/', [ProductCollectionController::class , 'index'])->name('collections.index');
            Route::get('/create', [ProductCollectionController::class , 'create'])->name('collections.create');
            Route::post('/store', [ProductCollectionController::class , 'store'])->name('collections.store');
            Route::get('/{id}/edit', [ProductCollectionController::class , 'edit'])->name('collections.edit');
            Route::put('/{id}', [ProductCollectionController::class , 'update'])->name('collections.update');
            Route::delete('/{id}', [ProductCollectionController::class , 'destroy'])->name('collections.destroy');
            Route::post('/bulk-delete', [ProductCollectionController::class , 'bulkDelete'])->name('collections.bulk-delete');
        }
        );

        // Taxes Routes
        Route::group(['prefix' => 'taxes'], function () {
            Route::get('/', [TaxController::class , 'index'])->name('taxes.index');
            Route::get('/create', [TaxController::class , 'create'])->name('taxes.create');
            Route::post('/store', [TaxController::class , 'store'])->name('taxes.store');
            Route::get('/{id}/edit', [TaxController::class , 'edit'])->name('taxes.edit');
            Route::put('/{id}', [TaxController::class , 'update'])->name('taxes.update');
            Route::delete('/{id}', [TaxController::class , 'destroy'])->name('taxes.destroy');
            Route::post('/bulk-delete', [TaxController::class , 'bulkDelete'])->name('taxes.bulk-delete');
        }
        );

        // FAQs Routes
        Route::group(['prefix' => 'faqs'], function () {
            Route::get('/', [FaqController::class , 'index'])->name('faqs.index');
            Route::get('/create', [FaqController::class , 'create'])->name('faqs.create');
            Route::post('/store', [FaqController::class , 'store'])->name('faqs.store');
            Route::get('/{id}/edit', [FaqController::class , 'edit'])->name('faqs.edit');
            Route::put('/{id}', [FaqController::class , 'update'])->name('faqs.update');
            Route::delete('/{id}', [FaqController::class , 'destroy'])->name('faqs.destroy');
            Route::post('/bulk-delete', [FaqController::class , 'bulkDelete'])->name('faqs.bulk-delete');
        }
        );

        // Simple Sliders Routes
        Route::group(['prefix' => 'simple-sliders'], function () {
            Route::get('/', [SimpleSliderController::class , 'index'])->name('simple-sliders.index');
            Route::get('/create', [SimpleSliderController::class , 'create'])->name('simple-sliders.create');
            Route::post('/store', [SimpleSliderController::class , 'store'])->name('simple-sliders.store');
            Route::get('/{id}/edit', [SimpleSliderController::class , 'edit'])->name('simple-sliders.edit');
            Route::put('/{id}', [SimpleSliderController::class , 'update'])->name('simple-sliders.update');
            Route::delete('/{id}', [SimpleSliderController::class , 'destroy'])->name('simple-sliders.destroy');
            Route::post('/bulk-delete', [SimpleSliderController::class , 'bulkDelete'])->name('simple-sliders.bulk-delete');

            // Items within a slider
            Route::group(['prefix' => 'items'], function () {
                    Route::get('/create', [SimpleSliderItemController::class , 'create'])->name('simple-sliders.items.create');
                    Route::post('/store', [SimpleSliderItemController::class , 'store'])->name('simple-sliders.items.store');
                    Route::get('/{id}/edit', [SimpleSliderItemController::class , 'edit'])->name('simple-sliders.items.edit');
                    Route::put('/{id}', [SimpleSliderItemController::class , 'update'])->name('simple-sliders.items.update');
                    Route::delete('/{id}', [SimpleSliderItemController::class , 'destroy'])->name('simple-sliders.items.destroy');
                }
                );
            }
            );

            // Announcements Routes
            Route::post('/announcements/bulk-delete', [AnnouncementController::class , 'bulkDelete'])->name('announcements.bulk-delete');
            Route::resource('announcements', AnnouncementController::class);


            Route::group(['prefix' => 'marketplaces'], function () {
            Route::get('stores', [AdminStoreController::class , 'index'])->name('marketplace.store.index');
            Route::get('reports', [ReportsController::class , 'reports'])->name('marketplace.reports');
            Route::get('withdrawls', [WithdrawlsController::class , 'withdrawls'])->name('marketplace.withdrawls');
            Route::get('vendors', [VendorController::class , 'vendors'])->name('marketplace.vendors');
            Route::get('vendors/{id}', [VendorController::class , 'show'])->name('marketplace.vendors.show');
            Route::get('vendors/{id}/edit', [VendorController::class , 'edit'])->name('marketplace.vendors.edit');
            Route::put('vendors/{id}', [VendorController::class , 'update'])->name('marketplace.vendors.update');
            Route::delete('vendors/{id}', [VendorController::class , 'destroy'])->name('marketplace.vendors.destroy');
            Route::post('vendors/bulk-delete', [VendorController::class , 'bulkDelete'])->name('marketplace.vendors.bulk-delete');
            Route::post('vendors/{id}/approve', [VendorController::class , 'approve'])->name('marketplace.vendors.approve');
            Route::post('vendors/{id}/reject', [VendorController::class , 'reject'])->name('marketplace.vendors.reject');
            Route::post('vendors/{id}/check-kyc', [VendorController::class , 'checkKycStatus'])->name('marketplace.vendors.check-kyc');
            Route::get('unverified-vendors', [VendorController::class , 'unverifiedVendors'])->name('marketplace.unverified-vendors');
            Route::get('unverified-vendors/{id}/verify', [VendorController::class , 'verify'])->name('marketplace.unverified-vendors.verify');
            Route::get('messages', [VendorController::class , 'messages'])->name('marketplace.messages');
            Route::get('stores/create', [AdminStoreController::class , 'create'])->name('marketplace.store.create');
            Route::post('stores', [AdminStoreController::class , 'store'])->name('marketplace.store.store');
            Route::get('stores/{store}', [AdminStoreController::class , 'show'])->name('marketplace.store.show');
            Route::get('stores/{store}/edit', [AdminStoreController::class , 'edit'])->name('marketplace.store.edit');
            Route::put('stores/{store}', [AdminStoreController::class , 'update'])->name('marketplace.store.update');

            Route::delete('stores/{store}', [AdminStoreController::class , 'destroy'])->name('marketplace.store.destroy');
            Route::post('stores/bulk-delete', [AdminStoreController::class , 'bulkDelete'])->name('marketplace.store.bulk-delete');
            Route::post('stores/{store}/verify', [AdminStoreController::class , 'verify'])->name('marketplace.store.verify');
            Route::delete('messages/{id}', [VendorController::class , 'destroyMessage'])->name('marketplace.messages.destroy');
            Route::post('messages/bulk-delete', [VendorController::class , 'bulkDeleteMessages'])->name('marketplace.messages.bulk-delete');
        }
        );


        Route::get('pages', [AdminPageController::class , 'index'])->name('pages.index');
        Route::get('pages/create', [AdminPageController::class , 'create'])->name('pages.create');
        Route::post('pages', [AdminPageController::class , 'store'])->name('pages.store');
        Route::get('pages/{id}', [AdminPageController::class , 'show'])->name('pages.show');
        Route::get('pages/{id}/edit', [AdminPageController::class , 'edit'])->name('pages.edit');
        Route::put('pages/{id}', [AdminPageController::class , 'update'])->name('pages.update');
        Route::delete('pages/{id}', [AdminPageController::class , 'destroy'])->name('pages.destroy');
        // Bulk delete for pages
        Route::post('pages/bulk-delete', [AdminPageController::class , 'bulkDelete'])->name('pages.bulk-delete');

        // Blog Posts
        Route::get('blog/posts', [PostController::class , 'index'])->name('blog.posts.index');
        Route::get('blog/posts/create', [PostController::class , 'create'])->name('blog.posts.create');
        Route::post('blog/posts', [PostController::class , 'store'])->name('blog.posts.store');
        Route::get('blog/posts/{post}/edit', [PostController::class , 'edit'])->name('blog.posts.edit');
        Route::put('blog/posts/{post}', [PostController::class , 'update'])->name('blog.posts.update');
        Route::delete('blog/posts/{post}', [PostController::class , 'destroy'])->name('blog.posts.destroy');
        Route::post('blog/posts/bulk-delete', [PostController::class , 'bulkDelete'])->name('blog.posts.bulk-delete');

        // Blog Categories
        Route::get('blog/categories', [BlogCategoryController::class , 'index'])->name('blog.categories.index');
        Route::get('blog/categories/bulk-delete', function () {
            return redirect()->route('admin.blog.categories.index');
        }
        );
        Route::post('blog/categories/bulk-delete', [BlogCategoryController::class , 'bulkDelete'])->name('blog.categories.bulk-delete');
        Route::post('blog/categories', [BlogCategoryController::class , 'store'])->name('blog.categories.store');
        Route::get('blog/categories/{category}/edit', [BlogCategoryController::class , 'edit'])->name('blog.categories.edit');
        Route::put('blog/categories/{category}', [BlogCategoryController::class , 'update'])->name('blog.categories.update');
        Route::delete('blog/categories/{category}', [BlogCategoryController::class , 'destroy'])->name('blog.categories.destroy');

        // Blog Tags
        Route::get('blog/tags', [TagController::class , 'index'])->name('blog.tags.index');
        Route::get('blog/tags/create', [TagController::class , 'create'])->name('blog.tags.create');
        Route::post('blog/tags', [TagController::class , 'store'])->name('blog.tags.store');
        Route::get('blog/tags/{tag}/edit', [TagController::class , 'edit'])->name('blog.tags.edit');
        Route::put('blog/tags/{tag}', [TagController::class , 'update'])->name('blog.tags.update');
        Route::delete('blog/tags/{tag}', [TagController::class , 'destroy'])->name('blog.tags.destroy');
        Route::post('blog/tags/bulk-delete', [TagController::class , 'bulkDelete'])->name('blog.tags.bulk-delete');


        // Route::resource('customers', AdminCustomerController::class);
        // Route::resource('customers', AdminCustomerController::class);
        Route::get('customers', [AdminCustomerController::class , 'index'])->name('customers.index');
        Route::get('customers/create', [AdminCustomerController::class , 'create'])->name('customers.create');
        Route::post('customers', [AdminCustomerController::class , 'store'])->name('customers.store');
        Route::get('customers/{id}/edit', [AdminCustomerController::class , 'edit'])->name('customers.edit');
        Route::put('customers/{id}', [AdminCustomerController::class , 'update'])->name('customers.update');
        Route::get('customers/{id}', [AdminCustomerController::class , 'show'])->name('customers.show');
        Route::delete('customers/{id}', [AdminCustomerController::class , 'destroy'])->name('customers.destroy');
        Route::post('customers/bulk-delete', [AdminCustomerController::class , 'bulkDelete'])->name('customers.bulk-delete');

        Route::post('customers/{id}/addresses', [AdminCustomerController::class , 'storeAddress'])->name('customers.addresses.store');
        Route::delete('customers/addresses/{address_id}', [AdminCustomerController::class , 'destroyAddress'])->name('customers.addresses.destroy');

        // Galleries Routes
        Route::get('galleries', [GalleryController::class , 'index'])->name('galleries.index');
        Route::get('galleries/create', [GalleryController::class , 'create'])->name('galleries.create');
        Route::post('galleries', [GalleryController::class , 'store'])->name('galleries.store');
        Route::get('galleries/{gallery}/edit', [GalleryController::class , 'edit'])->name('galleries.edit');
        Route::put('galleries/{gallery}', [GalleryController::class , 'update'])->name('galleries.update');
        Route::delete('galleries/{id}', [GalleryController::class , 'destroy'])->name('galleries.destroy');
        Route::post('galleries/bulk-delete', [GalleryController::class , 'bulkDelete'])->name('galleries.bulk-delete');

        // Testimonials Routes
        Route::get('testimonials', [TestimonialController::class , 'index'])->name('testimonials.index');
        Route::get('testimonials/create', [TestimonialController::class , 'create'])->name('testimonials.create');
        Route::post('testimonials', [TestimonialController::class , 'store'])->name('testimonials.store');
        Route::get('testimonials/{id}/edit', [TestimonialController::class , 'edit'])->name('testimonials.edit');
        Route::put('testimonials/{id}', [TestimonialController::class , 'update'])->name('testimonials.update');
        Route::delete('testimonials/{id}', [TestimonialController::class , 'destroy'])->name('testimonials.destroy');
        Route::post('testimonials/bulk-delete', [TestimonialController::class , 'bulkDelete'])->name('testimonials.bulk-delete');

        // Payments Transactions Routes
        Route::group(['prefix' => 'payments'], function () {
            Route::get('transactions', [PaymentTransactionController::class , 'index'])->name('payments.transactions.index');
            Route::delete('transactions/{id}', [PaymentTransactionController::class , 'destroy'])->name('payments.transactions.destroy');
            Route::post('transactions/bulk-delete', [PaymentTransactionController::class , 'bulkDelete'])->name('payments.transactions.bulk-delete');

            Route::get('logs', [PaymentLogController::class , 'index'])->name('payments.logs.index');
            Route::delete('logs/{id}', [PaymentLogController::class , 'destroy'])->name('payments.logs.destroy');
            Route::post('logs/bulk-delete', [PaymentLogController::class , 'bulkDelete'])->name('payments.logs.bulk-delete');

            Route::get('methods', [PaymentMethodController::class , 'index'])->name('payments.methods.index');
            Route::delete('methods/{id}', [PaymentMethodController::class , 'destroy'])->name('payments.methods.destroy');
            Route::post('methods/bulk-delete', [PaymentMethodController::class , 'bulkDelete'])->name('payments.methods.bulk-delete');
        }
        );

        Route::group(['prefix' => 'contacts'], function () {
            Route::get('/', [ContactController::class , 'index'])->name('contacts.list');
            Route::get('/{id}', [ContactController::class , 'show'])->name('contacts.show');
            Route::put('/{id}', [ContactController::class , 'update'])->name('contacts.update');
            Route::post('/reply/{id}', [ContactController::class , 'reply'])->name('contacts.reply');
            Route::delete('/{id}', [ContactController::class , 'destroy'])->name('contacts.destroy');
            Route::post('/bulk-delete', [ContactController::class , 'bulkDelete'])->name('contacts.bulk-delete');
        }
        );

        Route::get('/menu-items-count', [MenuCountController::class , 'getCounts'])->name('menu-items-count');

        // Footer Settings (Summary & All-in-One Edit)
        Route::get('/footer-settings', [FooterSettingController::class, 'index'])->name('footer-settings.index');
        Route::get('/footer-settings/edit', [FooterSettingController::class, 'edit'])->name('footer-settings.edit');
        Route::post('/footer-settings/update', [FooterSettingController::class, 'update'])->name('footer-settings.update');
    });
