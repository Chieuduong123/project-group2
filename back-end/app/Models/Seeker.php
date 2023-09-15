<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Seeker extends Authenticatable implements CanResetPassword
{
    use HasFactory, HasApiTokens, SoftDeletes, Notifiable;
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
