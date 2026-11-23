<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_JOB_SEEKER = UserRole::JOB_SEEKER->value;

    public const ROLE_EMPLOYER = UserRole::EMPLOYER->value;

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
        ];
    }

    /**
     * Get the backing UserRole enum instance, if valid.
     */
    public function roleEnum(): ?UserRole
    {
        return is_string($this->role) ? UserRole::tryFrom($this->role) : null;
    }

    /**
     * Check if the user is a job seeker.
     */
    public function isJobSeeker(): bool
    {
        return $this->role === UserRole::JOB_SEEKER->value;
    }

    /**
     * Check if the user is an employer.
     */
    public function isEmployer(): bool
    {
        return $this->role === UserRole::EMPLOYER->value;
    }
}
