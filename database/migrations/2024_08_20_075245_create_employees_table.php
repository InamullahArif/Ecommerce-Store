<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); 
            $table->string('full_name')->nullable(); 
            $table->string('email_address')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('date_of_birth')->nullable(); 
            $table->string('gender')->nullable();
            $table->text('address')->nullable(); 
            $table->string('username')->unique();
            $table->string('password')->nullable();
            $table->text('comments')->nullable(); 
            $table->string('contact_method')->default('email')->nullable();  
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
