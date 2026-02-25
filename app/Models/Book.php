<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Book extends Model
{
    use HasTranslations;

    protected $table = 'books';
    protected $fillable = ['name', 'author', 'book_category_id', 'image_path','book_file_path', 'description'];

    protected $translatable = ['name','author','image_path','book_file_path', 'description'];

    public function bookCategory()
    {
        return $this->belongsTo(BookCategory::class,'book_category_id');
    }

}
