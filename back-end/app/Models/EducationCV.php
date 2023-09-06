<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationCV extends Model
{
    use HasFactory;

    protected $fillable = [
        'cv_id',
        'education_id',
    ];
    protected $table = "education_cvs";

    public function curriculumVitea()
    {
        return $this->belongsTo(CurriculumVitae::class);
    }

    public function education()
    {
        return $this->belongsTo(Education::class);
    }
}
