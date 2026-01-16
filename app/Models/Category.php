<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'image_path'];

    protected $table = 'categories';
    protected $fillable = ['name', 'image_path', 'is_active', 'description'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
