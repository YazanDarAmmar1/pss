<section class="cart-section pt-100 pt-50-p section-padding-b">
    <div class="container">
        @if(count($cartItems) > 0)
            <livewire:home.cart.car-table
                :cartItems="$cartItems"
                :cartTotal="$cartTotal"
                :key="count($cartItems) . '-' . $cartTotal"
            />
        @else
            <livewire:home.cart.cart-empty/>
        @endif
    </div>
</section>

