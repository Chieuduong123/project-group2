<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumVitae extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'link_website',
        'introduce',
        'work_experience',
        'education',
        'skill',
        'position_apply',
        'activities',
        'certificates',
        'project',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'link_website' => 'array',
        'work_experience' => 'array',
        'skill' => 'array',
        'activities' => 'array',
        'certificates' => 'array',
        'project' => 'array',

    ];

    public function seeker()
    {
        return $this->belongsTo(Seeker::class);
    }
}
