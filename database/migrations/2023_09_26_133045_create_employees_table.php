<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            $table->string('name');

            $table->string('email')
                ->nullable()
                ->unique();

            $table->string('phone')
                ->unique();

            $table->string('national_id')
                ->nullable()
                ->unique();


            /*
            |--------------------------------------------------------------------------
            | Personal Information
            |--------------------------------------------------------------------------
            */

            $table->date('birth_date')
                ->nullable();

            $table->enum('gender', [
                'male',
                'female',
            ])->nullable();

            $table->enum('marital_status', [
                'single',
                'married',
                'divorced',
                'widowed',
            ])->nullable();

            $table->text('address')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Employment Information
            |--------------------------------------------------------------------------
            */

            $table->foreignId('department_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('job_title')
                ->nullable();

            $table->date('hire_date')
                ->nullable();

            $table->date('termination_date')
                ->nullable();

            $table->enum('employment_status', [
                'active',
                'suspended',
                'terminated',
            ])->default('active');

            $table->enum('contract_type', [
                'full_time',
                'part_time',
                'contractor',
            ])->default('full_time');


            /*
            |--------------------------------------------------------------------------
            | Files
            |--------------------------------------------------------------------------
            */

            $table->string('photo')
                ->nullable();

            $table->string('personal_file')
                ->nullable();

            $table->string('contract_file')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Timestamps & Soft Deletes
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            $table->softDeletes();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
