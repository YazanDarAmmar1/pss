<?php

function getHomeGlobalModals()
{
    return [
        [
            'modal_id' => 'user_empty_basket_box_modal',
            'livewire_component' => 'home.cart.cart-empty',
            'emit_show' => 'show-user-empty-basket-box-modal',
            'emit_hide' => 'hide-user-empty-basket-box-modal',
            'details' => [
                'modal_dialog_class' => 'modal empty-cart-modal modal-center transition-in',
                'modal_name' => 'empty-cart-modal',
            ]
        ],
        [
            'modal_id' => 'user_basket_box_modal',
            'livewire_component' => 'home.cart.cart-index',
            'emit_show' => 'show-user-basket-box-modal',
            'emit_hide' => 'hide-user-basket-box-modal',
            'details' => [
                'modal_dialog_class' => 'modal cart-modal modal-center transition-in',
                'modal_name' => 'cart-modal',
            ]
        ],
        [
            'modal_id' => 'user_basket_added_modal',
            'livewire_component' => 'home.cart.cart-added-item',
            'emit_show' => 'show-user-basket-added-modal',
            'emit_hide' => 'hide-user-basket-added-modal',
            'details' => [
                'modal_dialog_class' => 'modal add-to-cart-modal modal-center',
                'modal_name' => 'add-to-cart-modal',
            ]
        ],
    ];
}
