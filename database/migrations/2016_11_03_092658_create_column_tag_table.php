<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('column_tag', function (Blueprint $table) {
            $table->integer('column_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            


            $table->timestamps();

            
            $table->primary(['column_id', 'tag_id']);
            $table->foreign('column_id')->references('id')->on('columns');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('column_tag');
    }
}
