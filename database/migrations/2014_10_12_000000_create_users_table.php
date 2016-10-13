<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name',30)->unique()->nullable();
            $table->char('email',40)->unique()->nullable();
            $table->char('mobile',20)->unique()->nullable();
            $table->char('password',150);

            $table->tinyInteger('mail_status',false,true)->default(0);
            $table->tinyInteger('mobile_status',false,true)->default(0);
            $table->tinyInteger('status',false,true)->default(0);//会员状态

            $table->tinyInteger('type',false,true)->default(0);//会员类型
            $table->unsignedInteger('register_time')->default(0);
            $table->unsignedBigInteger('register_ip')->default(0);
            $table->unsignedInteger('login_time')->default(0);
            $table->unsignedBigInteger('login_ip')->default(0);

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
        Schema::drop('users');
    }
}
