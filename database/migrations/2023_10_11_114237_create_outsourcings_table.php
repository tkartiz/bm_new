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
        Schema::create('outsourcings', function (Blueprint $table) {
            $table->id();
            $table->string('comment')->nullable();
            $table->string('specification')->nullable();
            $table->string('order_recipient');
            $table->integer('price_incl')->nullable();
            $table->integer('price_exc')->nullable();
            $table->string('price_list')->nullable();
            $table->string('remarks')->nullable();
            $table->string('comp1_name');
            $table->integer('comp1_price_incl')->nullable();
            $table->integer('comp1_price_exc')->nullable();
            $table->string('comp1_file1')->nullable();
            $table->string('comp1_file2')->nullable();
            $table->string('comp1_file3')->nullable();
            $table->string('comp2_name')->nullable();
            $table->integer('comp2_price_incl')->nullable();
            $table->integer('comp2_price_exc')->nullable();
            $table->string('comp2_file1')->nullable();
            $table->string('comp2_file2')->nullable();
            $table->string('comp2_file3')->nullable();
            $table->string('comp3_name')->nullable();
            $table->integer('comp3_price_incl')->nullable();
            $table->integer('comp3_price_exc')->nullable();
            $table->string('comp3_file1')->nullable();
            $table->string('comp3_file2')->nullable();
            $table->string('comp3_file3')->nullable();
            $table->integer('appd1_id');
            $table->boolean('appd1_approval');
            $table->string('appd1_comment')->nullable();
            $table->date('appd1_appd_at');
            $table->integer('appd2_id');
            $table->boolean('appd2_approval');
            $table->string('appd2_comment')->nullable();
            $table->date('appd2_appd_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outsourcings');
    }
};
