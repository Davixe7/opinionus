<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
          $table->id();
          $table->timestamps();
          $table->string('name');
          $table->string('image')->nullable();
          $table->string('url')->nullable();
          $table->text('iframe')->nullable();
          $table->unsignedInteger('duration')->default(60);
          $table->boolean('enabled')->default(0);
          $table->dateTime('expires_at')->nullable();
          $table->enum('type', ['dashboard','results'])->default('results');
          $table->unsignedBigInteger('user_id')->nullable();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->unsignedBigInteger('survey_id')->nullable();
          $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
