<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_date',
        'to_date',
        'location',
        'title',
        'summary',
    ];
    protected $table = "experiences";

    public function curriculumVitaes()
    {
        return $this->belongsToMany(CurriculumVitae::class, 'experience_cvs',  'experience_id', 'cv_id');
    }
}
