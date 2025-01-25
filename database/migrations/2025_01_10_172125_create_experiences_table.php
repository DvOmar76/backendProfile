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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company');
            $table->text('description');
            $table->text('imageUrl');
            $table->text('linkCompany');
            $table->string('typeWork');
            $table->string('locationType');
            $table->string('counter');
            $table->string('city');
            $table->string('start');
            $table->string('end');
            $table->string('total');
            $table->text('certificateUrl');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
