<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'seeker_id',
        'position',
        'type',
        'level',
        'salary',
        'skill',
        'location',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'level' => 'array',
        'skill' => 'array',
        'type' => 'array'
    ];
}
