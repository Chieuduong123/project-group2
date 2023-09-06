<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $fillable = [
        'cv_id',
        'language_id',
    ];
    protected $table = "skills";
    public function curriculumVitea()
    {
        return $this->belongsTo(CurriculumVitae::class);
    }
    public function languages()
    {
        return $this->hasMany(Language::class);
    }
}
