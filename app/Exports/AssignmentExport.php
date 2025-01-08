<?php

namespace App\Exports;

use App\Models\Assignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AssignmentExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Assignment::with('submissions.user')
            ->get()
            ->flatMap(function ($assignment) {
                return $assignment->submissions->map(function ($submission) use ($assignment) {
                    return [
                        'ID Tugas' => $assignment->id,
                        'Judul Tugas' => $assignment->judul,
                        'ID Pengumpulan' => $submission->id,
                        'Target' => $assignment->target,
                        'Realisasi' => $submission->realisasi,
                        'Satuan' => $assignment->satuan,
                        'Username' => $submission->user->name,
                        'Nama Tim' => $submission->user->teams->pluck('name')->join(', ') ?? 'No Teams',
                        'Link Tugas' => $submission->link_tugas,
                        'Komentar' => $assignment->keterangan,
                        'Approval Status' => $submission->approval_status_label,
                        'Tanggal Tugas' => $assignment->created_at->format('d-m-Y'),
                        'Tanggal Submit' => $submission->created_at->format('d-m-Y'),
                    ];
                });
            });
    }

    public function headings(): array
    {
        return ['ID Tugas', 'Judul Tugas', 'ID Pengumpulan', 'Target', 'Realisasi', 'Satuan', 'Username', 'Nama Tim', 'Link Tugas', 'Approval Status', 'Tanggal Tugas', 'Tanggal Submit'];
    }
}
