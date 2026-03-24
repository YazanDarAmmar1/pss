<?php

namespace App\Http\Middleware;

use App\Services\CartService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCartHasItems
{
    public function handle($request, Closure $next)
    {
        $cart = (new CartService())->all();

        if (empty($cart['items']) || count($cart['items']) === 0) {
            return redirect()->route('cart');
        }

        return $next($request);
    }
}
