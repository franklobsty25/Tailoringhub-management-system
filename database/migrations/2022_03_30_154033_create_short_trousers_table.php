<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_trousers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->integer('waist')->default(0);
            $table->integer('length')->default(0);
            $table->integer('thighs')->default(0);
            $table->integer('bass_bottom')->default(0);
            $table->integer('seat')->default(0);
            $table->integer('knee')->default(0);
            $table->integer('flap_fly')->default(0);
            $table->integer('hip')->default(0);
            $table->integer('waist_knee')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('short_trousers');
    }
};
