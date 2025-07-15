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
        Schema::create('drying_result_calculations', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('paddy_id')->constrained('paddies')->onDelete('cascade');
            $table->integer('initial_moisture_content');
            $table->integer('final_moisture_content');
            $table->integer('initial_bag_quantity');
            $table->integer('final_bag_quantity');
            $table->integer('approximate_loss');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drying_result_calculations');
    }
};
