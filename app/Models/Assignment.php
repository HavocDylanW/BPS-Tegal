<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'target',
        'satuan',
        'tgl_mulai',
        'tgl_selesai',
        'keterangan',
        'team_id',
        'created_by',
    ];

    protected $casts = [
        'tgl_selesai' => 'datetime',
        'tgl_realisasi' => 'datetime',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function isOverdue()
    {
        return $this->tgl_selesai && $this->tgl_selesai < now();
    }
}