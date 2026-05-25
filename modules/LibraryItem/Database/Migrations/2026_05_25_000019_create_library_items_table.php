<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('library_items', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('item_type');
            $table->string('storage_path');
            $table->unsignedBigInteger('file_size_bytes');
            $table->string('mime_type');
            $table->string('classifiable_type');
            $table->unsignedBigInteger('classifiable_id');
            $table->boolean('is_downloadable')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['classifiable_type', 'classifiable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_items');
    }
};
