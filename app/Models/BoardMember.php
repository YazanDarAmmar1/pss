<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BoardMember extends Model
{
    use HasTranslations;

    protected $translatable = ['name', 'position'];

    protected $fillable = ['name', 'position', 'image_path'];
    protected $table = 'board_members';
}
