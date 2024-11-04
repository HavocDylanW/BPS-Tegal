<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->references('id')->on('users')->onDelete('cascade'); // References the admin or superadmin who created the assignment
            $table->foreignId('team_id')->references('id')->on('teams')->onDelete('cascade'); // References the team for the assignment
            $table->string('judul');
            $table->integer('target');
            $table->string('satuan');
            $table->text('keterangan')->nullable();
            $table->date('tgl_mulai'); // Start date
            $table->date('tgl_selesai'); // End date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
