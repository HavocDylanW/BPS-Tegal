<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id', 'leader_id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'team_user', 'team_id', 'user_id');
    }

    // Define the creator of the team
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define members of the team
    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id'); // One leader per team
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'team_user'); // Many members per team
    }

    // Define the assignments relationship
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function submissions()
    {
        return $this->hasManyThrough(Submission::class, Assignment::class);
    }
}