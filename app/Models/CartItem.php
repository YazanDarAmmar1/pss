<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $table = 'cart_items';
    protected $fillable = ['cart_id', 'project_id', 'amount'];

    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }

    public function cart(){
        return $this->belongsTo(Cart::class,'cart_id');
    }
}
