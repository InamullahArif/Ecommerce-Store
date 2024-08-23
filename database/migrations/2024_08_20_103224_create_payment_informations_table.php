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
        Schema::create('payment_informations', function (Blueprint $table) {
            $table->id();
            $table->string('card_holder_name')->nullable();
            $table->string('credit_debit_card_number')->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('cvv')->nullable();
            $table->string('billing_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_informations');
    }
};
