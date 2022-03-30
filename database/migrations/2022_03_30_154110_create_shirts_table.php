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
        Schema::create('shirts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->integer('length')->default(0);
            $table->integer('chest')->default(0);
            $table->integer('back')->default(0);
            $table->integer('sleeve')->default(0);
            $table->integer('around_arm')->default(0);
            $table->integer('cuff')->default(0);
            $table->integer('collar')->default(0);
            $table->integer('across_chest')->default(0);
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
        Schema::dropIfExists('shirts');
    }
};
