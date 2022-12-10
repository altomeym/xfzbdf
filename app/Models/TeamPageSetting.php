<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamPageSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

}
