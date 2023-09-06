<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumVitae extends Model
{
    use HasFactory;

    protected $fillable = [
        'seeker_id',
        'personal_detail_id',
        'social_id',
        'soft',
        'tech',
    ];
    protected $table = "curriculum_vitaes";
    protected $casts = [
        'soft' => 'array',
        'tech' => 'array',
    ];

    public function seeker()
    {
        return $this->belongsTo(Seeker::class);
    }

    public function personalDetail()
    {
        return $this->belongsTo(PersonalDetail::class);
    }

    public function social()
    {
        return $this->belongsTo(Social::class);
    }

    public function educations()
    {
        return $this->belongsToMany(Education::class, 'education_cvs', 'cv_id', 'education_id')->withTimestamps();
    }

    public function experiences()
    {
        return $this->belongsToMany(Experience::class, 'experience_cvs', 'cv_id', 'experience_id')->withTimestamps();
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'skills', 'cv_id', 'language_id')->withTimestamps();
    }
}
