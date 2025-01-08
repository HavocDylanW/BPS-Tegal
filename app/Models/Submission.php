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
        'approval_status',
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

    // Helper methods to check approval status
    public function getApprovalStatusLabelAttribute()
    {
        return ['Pending', 'Approved', 'Rejected'][$this->approval_status] ?? 'Pending';
    }

    public function isPending()
    {
        return $this->approval_status === 0;
    }

    public function isApproved()
    {
        return $this->approval_status === 1;
    }

    public function isRejected()
    {
        return $this->approval_status === 2;
    }
}
