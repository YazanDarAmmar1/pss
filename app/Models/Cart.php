<?php

namespace App\Models;

use App\Enums\CartStatus;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = ['user_id', 'session_id', 'status'];

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'cart_id', 'id');
    }

    public function changeClose()
    {
        $this->status = CartStatus::CLOSE;
        return $this->save();
    }
}
