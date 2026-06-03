<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\DashboardController as FrontendDashboardController;

// Admin Controllers
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController as BackendProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\VariantController;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\ArticleController as BackendArticleController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\AboutController as BackendAboutController;
use App\Http\Controllers\Backend\ContactController as BackendContactController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

/*
|--------------------------------------------------------------------------
| Frontend Routes (Public)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Products
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProductController::class, 'show'])->name('show');
});

// Articles / Blog
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/{slug}', [ArticleController::class, 'show'])->name('show');
});

// Static Pages
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Login - Admin Only)
|--------------------------------------------------------------------------
*/

// Guest routes (only accessible when not logged in)
Route::middleware('guest')->group(function () {
    Route::get('/apps/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/apps/login', [LoginController::class, 'login'])->name('login.post');
});

// Auth routes (accessible when logged in)
Route::middleware('auth')->group(function () {
    Route::post('/apps/logout', [LoginController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Backend)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Products Management
    Route::resource('products', BackendProductController::class);
    
    // Categories Management
    Route::resource('categories', CategoryController::class);
    
    // Variants Management (nested under products)
    Route::prefix('products/{product}/variants')->name('products.variants.')->group(function () {
        Route::get('/', [VariantController::class, 'index'])->name('index');
        Route::post('/', [VariantController::class, 'store'])->name('store');
        Route::put('/{variant}', [VariantController::class, 'update'])->name('update');
        Route::delete('/{variant}', [VariantController::class, 'destroy'])->name('destroy');
    });
    
    // Stock Management
    Route::prefix('stock')->name('stock.')->group(function () {
        Route::get('/', [StockController::class, 'index'])->name('index');
        Route::post('/in', [StockController::class, 'stockIn'])->name('in');
        Route::post('/out', [StockController::class, 'stockOut'])->name('out');
        Route::get('/history', [StockController::class, 'history'])->name('history');
    });
    
    // Banners Management
    Route::resource('banners', BannerController::class);
    Route::post('banners/reorder', [BannerController::class, 'reorder'])->name('banners.reorder');
    
    // Testimonials Management
    Route::resource('testimonials', TestimonialController::class);
    
    // Articles Management
    Route::resource('articles', BackendArticleController::class);
    
    // Gallery Management (nested under products)
    Route::prefix('products/{product}/gallery')->name('products.gallery.')->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('index');
        Route::post('/', [GalleryController::class, 'store'])->name('store');
        Route::delete('/{gallery}', [GalleryController::class, 'destroy'])->name('destroy');
        Route::post('/reorder', [GalleryController::class, 'updateOrder'])->name('reorder');
    });
    
    // Settings Pages
    Route::get('/about', [BackendAboutController::class, 'index'])->name('about.index');
    Route::put('/about', [BackendAboutController::class, 'update'])->name('about.update');
    
    Route::get('/contact', [BackendContactController::class, 'index'])->name('contact.index');
    Route::put('/contact', [BackendContactController::class, 'update'])->name('contact.update');
});