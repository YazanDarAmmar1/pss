<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BankAccount extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $table = 'bank_accounts';
    protected $fillable = ['name', 'account_number', 'currency'];
}
