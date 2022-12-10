<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Common\Imageable;

class ShopAppearance extends Model
{
    use HasFactory, Imageable;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'popular_links' => 'array',
        'slider_links' => 'array',
        'info_section_bullets' => 'array',
        'featured_products' => 'array',
    ];

    /**
     * The function is used to find scret column name.
     *
     * @var string
     */
    
     
    function fillableFind($type)
    {
        $arr = [
            'heading' => 'heading_text',
            'popular' => 'popular_links',
            'slider' => 'slider_links',
            'info_heading' => 'info_section_heading',
            'info_paragraph' => 'info_section_paragraph',
            'info_bullets' => 'info_section_bullets',
            'banners' => 'info_section_banners',
            'hot' => 'hot_product',
            'feature' => 'featured_products'
        ];

        return @$arr[$type];
    }
}
