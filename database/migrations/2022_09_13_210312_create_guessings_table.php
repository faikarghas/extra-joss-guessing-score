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
        Schema::create('guessings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_match')->constrained('matches')->onDelete('cascade');
            $table->integer('guessing_score_a');
            $table->integer('guessing_score_b');
            $table->tinyInteger('guessing_result')->nullable();
            $table->tinyInteger('status')->nullable()->default('0');
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
        Schema::dropIfExists('guessings');
    }
};
