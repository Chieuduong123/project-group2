<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceCV extends Model
{
    use HasFactory;
    protected $fillable = [
        'cv_id',
        'experience_id',
    ];
    protected $table = "experience_cvs";

    public function curriculumVitea()
    {
        return $this->belongsTo(CurriculumVitae::class);
    }

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }
}
