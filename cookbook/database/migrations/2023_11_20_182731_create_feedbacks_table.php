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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('comment');
            $table->integer('stars');
            $table->integer('recipe_id')->unsigned();
            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('approver_id')->unsigned();
            $table->foreign('approver_id')->references('id')->on('users')->nullable();
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
        Schema::dropIfExists('feedbacks');
    }
};
