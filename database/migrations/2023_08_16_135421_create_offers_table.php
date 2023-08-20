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
            $table->float('position_x')->default(42.69770050048828);
            $table->float('position_y')->default(23.32180404663086);
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
