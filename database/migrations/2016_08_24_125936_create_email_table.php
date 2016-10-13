<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            //

            $table->increments('id');
            $table->string('to',50);
            $table->text('content');
            $table->string('type',50);

            $table->tinyInteger('created_type',false,true)->default(0);
            $table->tinyInteger('updated_type',false,true)->default(0);
            $table->tinyInteger('deleted_type',false,true)->default(0);

            $table->mediumInteger('created_uid',false,true)->default(0);
            $table->mediumInteger('updated_uid',false,true)->default(0);
            $table->mediumInteger('deleted_uid',false,true)->default(0);

            $table->unsignedInteger('created_at')->default(0);
            $table->unsignedInteger('updated_at')->default(0);
            $table->unsignedInteger('deleted_at')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('emails', function (Blueprint $table) {
            //
        });
    }
}
