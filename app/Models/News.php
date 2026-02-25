<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description','short_description','image_path'];

    protected $table = 'news';
    protected $fillable = ['name', 'description', 'is_active', 'short_description', 'image_path','date'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    public function getDateHumanAttribute(): string
    {
        $locale = app()->getLocale();

        Carbon::setLocale($locale);

        if ($locale === 'ar') {
            return $this->created_at->translatedFormat('d F Y');
        }
        return $this->created_at->format('d M Y');
    }
}
