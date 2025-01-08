<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'gender',
        'phone',
        'address',
        'password',
        'profile_picture',
    ];    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // Define teams the user belongs to
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_user'); // Many teams per user
    }

    // Define teams the user created
    public function createdTeams()
    {
        return $this->hasMany(Team::class, 'user_id'); // One creator per team
    }

    // Define teams the user leads
    public function ledTeams()
    {
        return $this->hasMany(Team::class, 'leader_id'); // One leader per team
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class, 'employee_id');
    }

    public function getProfilePictureAttribute($value)
    {
        return $value ? 'storage/profile_pictures/' . $value : null; // Adjust path as needed
    }
}
