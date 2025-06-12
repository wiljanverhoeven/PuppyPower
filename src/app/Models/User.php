<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Training;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => 'string',
        ];
    }

    /**
     * Get the trainings associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function myTrainings(): HasMany
    {
        return $this->hasMany(MyTraining::class, 'user_id');
    }

    public function trainings()
    {
        return $this->belongsToMany(Training::class, 'mytrainings', 'user_id', 'training_id');
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class, 'admin_id');
    }


    /**
     * Check if the user has admin role
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

}
