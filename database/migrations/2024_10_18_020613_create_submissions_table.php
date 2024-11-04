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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->references('id')->on('assignments')->onDelete('cascade'); // References the assignment
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade'); // References the employee (user)
            $table->string('link_tugas')->nullable();
            $table->integer('realisasi'); // Link to the submitted task
            $table->timestamp('tgl_dikumpulkan')->nullable(); // Add this line for the submission date
            $table->date('tgl_realisasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
