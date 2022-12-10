<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureInventory extends Model
{
    use HasFactory;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feature_inventory';

    /**
     * Get the FeatureType for the Feature.
     */
    public function feature()
    {
        return $this->hasOne(Feature::class,'id','feature_id');
    }

    /**
     * Feature has many FeatureValue
     */
    public function feature_value()
    {
        return $this->hasOne(FeatureValue::class,'id','feature_value_id')->orderBy('order', 'asc');
    }
}
