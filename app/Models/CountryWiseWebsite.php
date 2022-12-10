<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\SoftDeletes;

class CountryWiseWebsite extends BaseModel
{
    // use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'country_wise_websites';

    protected $fillable = [
        'country_id',
        'website',
    ];


    /**
     * Get the country associated with the model.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }


}
