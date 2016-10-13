<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclDataRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acl_data_roles', function (Blueprint $table) {
            $table->unsignedInteger('data_id')->defalut(0);
            $table->unsignedInteger('role_id')->defalut(0);
            $table->char('type',50);

            $table->primary(['data_id','role_id','type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('acl_data_roles');
    }
}
