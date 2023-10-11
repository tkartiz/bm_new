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
        Schema::create('workspecs', function (Blueprint $table) {
            $table->id();
            $table->string('size');
            $table->string('format');
            $table->string('article');
            $table->string('severity');
            $table->integer('quantity');
            $table->string('unit');
            $table->boolean('outsourcing');
            $table->unsignedBigInteger('outsourcing_id')->nullable();
            $table->integer('subttl_price_incl')->nullable();
            $table->integer('subttl_price_exc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workspecs');
    }
};
