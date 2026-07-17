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
        Schema::create('whyuses', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title_ar')->unique();
            $table->string('title_en')->unique();
            $table->longText('description_ar');
            $table->longText('description_en');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
