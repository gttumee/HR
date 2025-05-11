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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('dob');
            $table->date('hire_date')->nullable();
            $table->date('resignation_date')->nullable();
            $table->text('resignation_reason')->nullable();
            $table->text('person_additional')->nullable();
            $table->text('job_additional')->nullable();
            $table->string('job_type');
            $table->string('position');
            $table->decimal('salary', 10, 2);
            $table->unsignedBigInteger('deployment_id');
            $table->foreign('deployment_id')
                  ->references('id')->on('deployments')
                  ->onDelete('cascade'); 
            $table->timestamps();
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