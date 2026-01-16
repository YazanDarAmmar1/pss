<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'image_path', 'description', 'first_button_text', 'second_button_text',
        'first_button_link', 'second_button_link'];

    protected $table = 'sliders';
    protected $fillable = ['name', 'description', 'image_path', 'status', 'first_button_visibility',
        'second_button_visibility', 'first_button_text', 'second_button_text', 'first_button_link',
        'second_button_link'];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
