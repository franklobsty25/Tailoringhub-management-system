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
        Schema::create('kaba_slits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->integer('bust')->default(0);
            $table->integer('waist')->default(0);
            $table->integer('hip')->default(0);
            $table->integer('shoulder')->default(0);
            $table->integer('shoulder_nipple')->default(0);
            $table->integer('nipple_nipple')->default(0);
            $table->integer('nape_waist')->default(0);
            $table->integer('shoulder_waist')->default(0);
            $table->integer('shoulder_hip')->default(0);
            $table->integer('across_chest')->default(0);
            $table->integer('kaba_length')->default(0);
            $table->integer('sleeve_length')->default(0);
            $table->integer('around_arm')->default(0);
            $table->integer('across_back')->default(0);
            $table->integer('slit_length')->default(0);
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
        Schema::dropIfExists('kaba_slits');
    }
};
