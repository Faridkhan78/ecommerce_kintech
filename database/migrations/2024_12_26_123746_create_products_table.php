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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Product name
            $table->text('desc')->nullable(); // Product description
            $table->decimal('price', 10, 2); // Product price (10 digits, 2 decimal places)
            $table->integer('qty'); // Quantity
            $table->string('image')->nullable(); // Image path
            $table->boolean('status')->default(1); // Status (1 = active, 0 = inactive)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
