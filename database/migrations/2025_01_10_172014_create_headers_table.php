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
        Schema::create('headers', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['header', 'courses', 'experiences','contact','career'])->unique(); // Use enum for predefined types
            $table->string('titleAr');
            $table->text('descriptionAr');
            $table->string('titleEn');
            $table->text('descriptionEn');
            $table->text('imageUrl');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('headers');
    }
};
