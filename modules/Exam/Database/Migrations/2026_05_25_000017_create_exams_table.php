<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->unsignedSmallInteger('question_count');
            $table->unsignedTinyInteger('passing_score_percent')->default(70);
            $table->unsignedSmallInteger('time_limit_minutes')->nullable();
            $table->json('unit_tags_filter')->nullable();
            $table->json('lesson_ids_filter')->nullable();
            $table->string('generation_strategy')->default('random');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
