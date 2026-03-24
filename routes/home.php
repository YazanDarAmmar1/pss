<?php

use App\Enums\PaymentStatus;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'ar|en']], function () {

    Route::get('/auth/logout', function () {
        Auth::guard('app')->logout();
        return redirect(route('login'));

    })->name('user.auth.logout');

    Route::middleware('guest')->group(function () {
        Route::get('/login', \App\Livewire\Home\Login::class)->name('login');
    });

    Route::get('/', \App\Livewire\Home\Index::class)->name('home');

    Route::get('/news', \App\Livewire\Home\News\Index::class)->name('news');
    Route::get('/news-details/{news_id}', \App\Livewire\Home\Components\NewsDetailsPage::class)->name('news.details');
    Route::get('/library', \App\Livewire\Home\Library\Index::class)->name('library');
    Route::get('/projects', \App\Livewire\Home\Projects\Index::class)->name('projects');
    Route::get('/projects/details/{no}', \App\Livewire\Home\Projects\Details::class)->name('projects.details');
    Route::get('/contact-us', \App\Livewire\Home\ContactUs::class)->name('contact-us');
    Route::get('/about-us', \App\Livewire\Home\AboutUs::class)->name('about-us');
    Route::get('/checkout', App\Livewire\Home\Checkout\Index::class)->name('checkout')->middleware('cartHasItems');
    Route::get('/cart', App\Livewire\Home\Cart\CartUpdate::class)->name('cart');
    Route::get('/success/{transaction}', App\Livewire\Home\SuccessPayment::class)->name('success-payment');
    Route::get('/failed/{transaction}', App\Livewire\Home\FailedPayment::class)->name('failed-payment');
});
