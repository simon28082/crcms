<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMailCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_mail_codes', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id')->default(0);
            $table->char('type',50);
            $table->char('hash',40)->unique();
            $table->tinyInteger('status',false,true)->default(0);

            //$table->timestamps();

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
        Schema::drop('user_mail_codes');
    }
}
