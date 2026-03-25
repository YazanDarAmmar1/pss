<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class AppUser extends Authenticatable
{
    protected $guard = 'app';
    protected $table = 'app_users';

    protected $fillable = ['name', 'email', 'password', 'phone', 'country_id',
        'image_path'];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function receipts(): HasMany
    {
        return $this->hasMany(Receipt::class, 'app_user_id');
    }

    public function getFullImagePathAttribute()
    {
        if ($this->image_path) {
            return asset($this->image_path);
        }
        return asset('home-assets/images/land1.jpg');
    }

}
