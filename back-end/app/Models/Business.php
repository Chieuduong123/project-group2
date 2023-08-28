<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Business extends Authenticatable
{
    use HasFactory, HasApiTokens;

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
    ];
    protected $table = "businesses";
    protected $guarded = [];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
