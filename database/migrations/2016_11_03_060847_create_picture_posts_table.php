<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picture_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('picture');
            $table->text('description')->nullable();
            $table->integer('post_id')->unsigned();
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('picture_posts');
    }
}
