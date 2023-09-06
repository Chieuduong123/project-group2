<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
    ];
    protected $table = "languages";

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
    public function curriculumVitaes()
    {
        return $this->belongsToMany(CurriculumVitae::class, 'skills',  'language_id', 'cv_id');
    }
}
