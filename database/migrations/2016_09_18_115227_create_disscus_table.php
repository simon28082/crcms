<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisscusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discuss', function (Blueprint $table) {
            $table->increments('id');
            $table->char('title',255)->unique()->nullable();

            $table->tinyInteger('status',false,true)->default(0);//状态

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
        Schema::drop('discuss');
    }
}
