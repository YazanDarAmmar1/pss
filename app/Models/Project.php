<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasTranslations;

    protected $table = 'projects';
    protected $translatable = ['name', 'description', 'image_path', 'short_description'];
    protected $fillable = ['name', 'category_id', 'status', 'date_start', 'date_end',
        'target_amount', 'paid_amount', 'remaining_amount', 'rate', 'image_path', 'description',
        'short_description', 'is_seasonal', 'seasonal_start', 'seasonal_end', 'hide_on_complete',
        'show_counter','default_amount'];
    protected $casts = [
        'status' => ProjectStatus::class,
        'hide_on_complete' => 'boolean',
        'show_counter' => 'boolean',
        'is_seasonal' => 'boolean',
        'description' => 'array',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if (!$model->no) {
                $model->no = $model->getNextNo();
            }
            if (!$model->created_at) {
                $model->created_at = Carbon::now();
            }
        });
    }

    public function getNextNo()
    {
        $carbon = Carbon::now();
        $shortYear = $carbon->format('y');

        $month = $this->created_at ? $this->created_at->format('m') : $carbon->format('m');
        $max_no = self::whereYear('created_at', '=', $carbon->year)
            ->whereMonth('created_at', '=', $month)
            ->where('no', 'like', $shortYear . $month . '%')
            ->max('no');

        if ($max_no) {
            $no = (int)substr($max_no, -3) + 1;
            $next_no = $shortYear . $month . str_pad($no, 3, '0', STR_PAD_LEFT);
        } else {
            $next_no = $shortYear . $month . '001';
        }

        return $next_no;
    }
    public function scopePublished($query)
    {
        $now = now();
        return $query->where('status', ProjectStatus::ACTIVE)
            ->where(function ($query) use ($now) {
                $query->where('date_start', '<=', $now)
                    ->orWhereNull('date_start');
            })
            ->where(function ($query) use ($now) {
                $query->where('date_end', '>=', $now)
                    ->orWhereNull('date_end');
            });
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getImageFullPathAttribute()
    {
        if ($this->image_path){
            return asset('storage/' . $this->image_path);
        }
    }
}
