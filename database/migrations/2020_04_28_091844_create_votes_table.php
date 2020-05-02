<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('votes', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->unsignedBigInteger('survey_id');
      $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');
      $table->unsignedBigInteger('choice_id');
      $table->foreign('choice_id')->references('id')->on('choices')->onDelete('cascade');
      $table->string('ip_address');
    });
  }
  
  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('votes');
  }
}
