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
        Schema::create('post_training_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('original_session_id');
            $table->foreign('original_session_id')->references('id')->on('training_sessions')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->unsignedBigInteger('responsible_user_id');
            $table->foreign('responsible_user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('post_training_sessions');
    }
};
