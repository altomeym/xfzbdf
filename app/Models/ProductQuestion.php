<?php

namespace App\Models;

use App\Common\CascadeSoftDeletes;
use App\Common\Feedbackable;
use App\Common\Imageable;
use App\Common\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

use Incevio\Package\Inspector\Traits\HasInspector;

class ProductQuestion extends BaseModel
{
    use HasInspector;

    // use HasFactory, SoftDeletes, CascadeSoftDeletes, Taggable, Imageable, Searchable, Feedbackable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    // protected $table = 'products';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'is_required',
        'question',
        'type',
    ];

}
