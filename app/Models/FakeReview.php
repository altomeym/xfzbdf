<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FakeReview extends BaseModel
{
    use HasFactory;

/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip',
        'rating',
    ];

}
