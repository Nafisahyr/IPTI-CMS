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
        Schema::create('curriculum_structures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_detail_id')
                ->constrained('program_details')
                ->onDelete('cascade');
            $table->integer('year');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('structure_curriculum');
    }
};
