<div>
    <div class="modal-body-wrapper">
        <div class="modal-body relative z-1 bg-white radius-24 radius-16-p pt-40 pb-40 px-40">
            <livewire:home.cart.car-table
                :cartItems="$cartItems"
                :cartTotal="$cartTotal"
                :key="count($cartItems) . '-' . $cartTotal"
            />
        </div>
    </div>
</div>
