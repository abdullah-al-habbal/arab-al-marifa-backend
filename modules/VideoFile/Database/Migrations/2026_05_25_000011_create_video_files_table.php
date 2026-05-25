<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('video_files', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete();
            $table->string('quality');
            $table->string('storage_path');
            $table->string('mime_type');
            $table->unsignedBigInteger('file_size_bytes');
            $table->unsignedInteger('duration_seconds');
            $table->timestamps();
            $table->unique(['lesson_id', 'quality']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_files');
    }
};
