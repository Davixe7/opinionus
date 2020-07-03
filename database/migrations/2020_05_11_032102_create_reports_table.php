<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('reports', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->string('subject');
      $table->text('description');
      $table->timestamp('read_at')->nullable();
      $table->unsignedBigInteger('survey_id');
      $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');
    });
  }
  
  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('reports');
  }
}
