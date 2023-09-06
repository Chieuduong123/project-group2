<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_date',
        'to_date',
        'location',
        'title',
        'summary',
    ];
    protected $table = "educations";

    public function curriculumVitaes()
    {
        return $this->belongsToMany(CurriculumVitae::class, 'education_cvs', 'education_id', 'cv_id');
    }
}
