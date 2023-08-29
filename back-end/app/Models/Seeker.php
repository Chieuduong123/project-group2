<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Seeker extends Authenticatable
{
    use HasFactory, HasApiTokens;
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'birthday',
        'address',
        'phone',
    ];
    protected $table = "seekers";
    protected $guarded = [];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function favoriteJobs()
    {
        return $this->belongsToMany(Job::class, 'favorites', 'seeker_id', 'job_id');
    }

    public function favourites()
    {
        return $this->hasMany(Favorite::class, 'job_id', 'id');
    }

    public function curriculumVitaes()
    {
        return $this->hasMany(CurriculumVitae::class);
    }
}