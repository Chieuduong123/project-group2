<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

    protected $fillable = [
        'github',
        'instagram',
        'facebook',
        'linkendin',
        'telegram',
        'twitter',
        'web',
    ];
    protected $table = "socials";

    public function curriculumVitea()
    {
        return $this->belongsTo(CurriculumVitae::class);
    }
}
