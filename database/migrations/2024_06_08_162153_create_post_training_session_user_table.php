<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTrainingSessionUserTable extends Migration
{
    public function up()
    {
        Schema::create('post_training_session_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_training_session_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('post_training_session_id')->references('id')->on('post_training_sessions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_training_session_user');
    }
}
