<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'position',
        'level',
        'type',
        'salary',
        'content',
        'requirement',
        'quantity',
        'skill',
        'benefits',
        'start_day',
        'end_date',
        'status',
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

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(Seeker::class, 'favorites', 'job_id', 'seeker_id');
    }
}
