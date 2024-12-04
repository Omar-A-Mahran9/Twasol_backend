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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name_ar')->unique();
            $table->string('name_en')->unique();
            $table->string('description_ar');
            $table->string('description_en');
            $table->double('price');
            $table->enum('status', ['Pending', 'Rejected', 'Approved']);
            $table->string('rejection_reason')->nullable();
            $table->string('meta_tag_key_words')->nullable();
            $table->string('meta_tag_key_description')->nullable();

            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
