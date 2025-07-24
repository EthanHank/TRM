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
        Schema::create('paddies', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('paddy_type_id')->constrained('paddy_types')->onDelete('cascade');
            $table->integer('bag_quantity');
            $table->integer('bag_weight');
            $table->integer('total_bag_weight');
            $table->integer('moisture_content');
            $table->date('storage_start_date')->nullable();
            $table->date('storage_end_date')->nullable();
            $table->string('maximum_storage_duration')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paddies');
    }
};
