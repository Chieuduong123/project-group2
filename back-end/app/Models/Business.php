<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Business extends Authenticatable
{
    use HasFactory, HasApiTokens, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'phone',
        'location',
        'website',
        'career',
        'size',
        'status',
    ];
    protected $table = "businesses";
    protected $guarded = [];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function jobApplications()
    {
        return $this->hasManyThrough(Application::class, Job::class);
    }
}
