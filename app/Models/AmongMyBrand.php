<?php

namespace App\Models;

use App\Common\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Relations\BelongsToMany;
// use Illuminate\Database\Eloquent\SoftDeletes;

class AmongMyBrand extends BaseModel
{
    use HasFactory, Imageable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'among_my_brands';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'about_my_work',
        'start_date',
        'end_date',
        'about_brand',
        'orderBy',
        'industry',
    ];
    
}
