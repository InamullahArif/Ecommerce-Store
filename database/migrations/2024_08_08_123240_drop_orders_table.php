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
       Schema::table('orders_users', function (Blueprint $table) {
        $table->dropForeign(['order_id']); 
    });
    Schema::dropIfExists('orders');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Add other columns you had in the orders table
            $table->timestamps();
        });
    }
};
