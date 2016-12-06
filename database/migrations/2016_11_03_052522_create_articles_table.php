<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            $table->string('picture');
            $table->boolean('isPublished');
            $table->boolean('inThumbnail');
            $table->integer('shares')->unsigned()->default(0);
            $table->integer('likes')->unsigned()->default(0);
            $table->integer('views')->unsigned()->default(0);
            $table->integer('column_id')->unsigned();
            $table->timestamps();

            $table->foreign('column_id')->references('id')->on('columns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
