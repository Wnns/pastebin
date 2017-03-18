<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePastesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pastes', function(Blueprint $table){

            $table->increments('id');
            $table->string('title');
            $table->string('content');
            $table->string('string_id');
            $table->string('author');
            $table->dateTime('created_at');
            $table->dateTime('expiry_at');
            $table->boolean('is_private');
            $table->integer('views');  
            $table->string('syntax');    

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pastes');
    }
}
