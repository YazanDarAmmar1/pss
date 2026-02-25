<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BookCategory extends Model
{
    use HasTranslations;
    protected $table = 'book_categories';
    protected $translatable = ['name'];

    protected $fillable = ['name', 'description'];
}
