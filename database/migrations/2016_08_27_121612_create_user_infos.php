<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {

            $table->increments('uid');

            $table->char('website',150);
            $table->char('introduction',255);
            $table->char('real_name',30);

            $table->unsignedSmallInteger('birthday_year')->default(0);
            $table->unsignedTinyInteger('birthday_month')->default(0);
            $table->unsignedSmallInteger('birthday_day')->default(0);

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
        Schema::drop('user_infos');
    }
}
