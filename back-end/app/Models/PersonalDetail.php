<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'job_title',
        'location',
        'email',
        'phone',
        'about_me',
    ];
    protected $table = "personal_details";

    public function curriculumVitea()
    {
        return $this->belongsTo(CurriculumVitae::class);
    }
}
