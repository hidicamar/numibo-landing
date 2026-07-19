<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegalPageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PricingController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localizationRedirect', 'localeViewPath', 'localize'],
], function () {
    Route::get(LaravelLocalization::transRoute('routes.home'), HomeController::class)->name('home');

    Route::get(LaravelLocalization::transRoute('routes.pricing'), PricingController::class)->name('pricing');

    Route::name('posts.')->group(function () {
        Route::get(LaravelLocalization::transRoute('routes.posts.index'), [PostController::class, 'index'])->name('index');
        Route::get(LaravelLocalization::transRoute('routes.posts.show'), [PostController::class, 'show'])->name('show');
    });

    Route::name('legal.')->group(function () {
        Route::get(LaravelLocalization::transRoute('routes.legal.privacy-policy'), LegalPageController::class)
            ->defaults('type', 'privacy-policy')
            ->name('privacy-policy');

        Route::get(LaravelLocalization::transRoute('routes.legal.terms-and-conditions'), LegalPageController::class)
            ->defaults('type', 'terms-and-conditions')
            ->name('terms-and-conditions');

        Route::get(LaravelLocalization::transRoute('routes.legal.cookies'), LegalPageController::class)
            ->defaults('type', 'cookies')
            ->name('cookies');
    });

    Livewire::setUpdateRoute(fn ($handle) => Route::post('/livewire/update', $handle));
});
