<?php

namespace App\Models;

// use App\Common\Attachable;
use App\Common\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuideLead extends BaseModel
{
    use HasFactory, Imageable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'guide_leads';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label',
        'title',
        'slug',
        'description',
        'pages',
        'type',
        'link',
        'btn_text',
        'bg_color',
        'color',
        'offer_text_1',
        'offer_text_2',
        'offer_text_3',
        'is_featured'
    ];

}
