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
        Schema::create('fmatches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_team_a')->constrained('countries')->onDelete('cascade');
            $table->foreignId('id_team_b')->constrained('countries')->onDelete('cascade');
            $table->integer('score_a');
            $table->integer('score_b');
            $table->string('goal_scorer_a')->nullable();
            $table->string('goal_scorer_b')->nullable();
            $table->string('round');
            $table->timestamp('round_expired_time')->nullable();
            $table->tinyInteger('match_status')->default('0');
            $table->timestamp('match_expired_time')->nullable();
            $table->timestamp('match_time')->nullable();
            $table->string('stadium')->nullable();
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
        Schema::dropIfExists('fmatches');
    }
};
