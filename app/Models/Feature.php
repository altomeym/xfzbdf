<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Get the FeatureType for the Feature.
     */
    public function feature_type()
    {
        return $this->belongsTo(FeatureType::class);
    }

    /**
     * Feature has many FeatureValue
     */
    public function feature_values()
    {
        return $this->hasMany(FeatureValue::class)->orderBy('order', 'asc');
    }
    

    // /**
    //  * Get the inventories for the Attribute.
    //  */
    // public function inventories()
    // {
    //     return $this->belongsToMany(Inventory::class, 'feature_inventory')
    //         ->withPivot('feature_value_id')
    //         ->withTimestamps();
    // }

    // /**
    //  * Get the categories for the attributes.
    //  */
    // public function categories(): BelongsToMany
    // {
    //     return $this->belongsToMany(Category::class, 'attribute_categories')->withTimestamps();
    // }
    

}
