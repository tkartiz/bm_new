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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('subject');
            $table->integer('works_quantity')->nullable();
            $table->unsignedBigInteger('works1_id')->nullable();
            $table->unsignedBigInteger('works2_id')->nullable();
            $table->unsignedBigInteger('works3_id')->nullable();
            $table->unsignedBigInteger('works4_id')->nullable();
            $table->unsignedBigInteger('works5_id')->nullable();
            $table->string('severity')->nullable();
            $table->integer('revision')->nullable();
            $table->date('applicated_at')->nullable();
            $table->date('desired_dlvd_at');
            $table->integer('ttl_price_exc')->nullable();
            $table->integer('ttl_price_incl')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
