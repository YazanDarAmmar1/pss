<?php

use Illuminate\Support\Facades\Route;

Route::fallback(function() {
    $locale = session('locale', 'ar');
    $path = request()->path();

    if ($path && !in_array(explode('/', $path)[0], ['ar', 'en'])) {
        return redirect("/{$locale}/{$path}");
    }

    return redirect("/{$locale}");
});

