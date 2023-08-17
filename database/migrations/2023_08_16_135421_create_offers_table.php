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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('item_id');
            $table->string('name');
            $table->string('description');
            $table->enum('quantity', ['kg', 'liter', 'number'])->default('kg');
            $table->integer('amount');
            $table->integer('price');
            $table->string('location')->nullable();
            $table->integer('position_x')->default(80);
            $table->integer('position_y')->default(240);
            $table->integer('width')->default(250);
            $table->integer('height')->default(150);
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
