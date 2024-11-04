<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'user_id', // The ID of the user submitting the assignment
        'realisasi',
        'link_tugas', // Link to the submitted assignment
        'tgl_realisasi',
        'tgl_pengumpulan', // Date of submission
    ];

    protected $casts = [
        'tgl_realisasi' => 'date:d-m-Y', // Automatically format as day-month-year
    ];

    // Define the relationship with Assignment
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
