<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'sitename_ar',
        'sitename_en',
        'logo',
        'icon',
        'email',
        'description',
        'keywords',
        'status',
        'msg_maintenance',
        'main_lang',
    ];
}
