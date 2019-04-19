<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('league_id');
            $table->foreign('league_id')->references('id')->on('leagues');
            $table->unsignedBigInteger('home');
            $table->foreign('home')->references('id')->on('teams');
            $table->unsignedBigInteger('away');
            $table->foreign('away')->references('id')->on('teams');
            $table->tinyInteger('home_goals')->default(0);
            $table->tinyInteger('away_goals')->default(0);
            $table->tinyInteger('week');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('matches');
    }
}
