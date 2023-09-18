<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Seeker extends Authenticatable implements CanResetPassword, HasMedia
{
    use HasFactory, HasApiTokens, SoftDeletes, Notifiable, InteractsWithMedia;
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

    public function attachLogo($path, $fileName = ''): self
    {
        if ($fileName === '') {
            $extension = Str::afterLast($path, '.');
            $fileName = strtolower(str_replace(['#', '/', '\\', ' '], '-', $this->name)) . '_' . $this->id . '.' . $extension;
        }

        $this->addMedia($path)
            ->usingFileName($fileName)
            ->usingName($this->name . '_' . $this->id)
            ->toMediaCollection('brands');

        return $this;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('brands')
            ->useDisk('brands')
            ->acceptsMimeTypes([
                'image/jpeg',
                'image/png',
                'image/svg+xml',
                'image/webp',
                'image/gif',
                'image/svg',
            ])
            ->singleFile();
    }
}
