<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclOtherPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acl_other_permissions', function (Blueprint $table) {
            $table->unsignedInteger('other_id')->defalut(0);
            $table->unsignedInteger('permission_id')->defalut(0);
            $table->primary(['other_id','permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('acl_other_permissions');
    }
}
