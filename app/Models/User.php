<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * The courses that the user has enrolled in.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class)->withTimestamps();
    }

    /**
     * NEW: Episodes that the user has interacted with or completed.
     * The 'withPivot' allows us to access the completion date.
     */
    public function episodes()
    {
        return $this->belongsToMany(Episode::class)
            ->withPivot('completed_at')
            ->withTimestamps();
    }
}