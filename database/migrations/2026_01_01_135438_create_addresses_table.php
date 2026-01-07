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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
                        $table->foreignId('order_id')->constrained()->onDelete('cascade'); // link to order
            $table->string('full_name');          // name of recipient
            $table->string('phone');              // phone number
            $table->string('country')->nullable();
            $table->string('city');
            $table->string('street_address');
            $table->string('postal_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};