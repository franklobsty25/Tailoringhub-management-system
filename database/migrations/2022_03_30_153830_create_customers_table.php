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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('firstName');
            $table->string('lastName');
            $table->index(['firstName', 'lastName', 'contact']);
            $table->integer('contact')->unique();
            $table->string('address')->nullable();
            $table->date('collectionDate');
            $table->integer('charge');
            $table->integer('advance');
            $table->integer('balance');
            $table->string('style')->nullable();
            $table->string('materialType')->nullable();
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
        Schema::dropIfExists('customers');
    }
};
