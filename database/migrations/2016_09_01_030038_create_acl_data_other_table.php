<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclDataOtherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acl_data_others', function (Blueprint $table) {
            $table->unsignedInteger('data_id')->defalut(0);;
            $table->unsignedInteger('other_id')->defalut(0);
            $table->char('type',50);

            $table->primary(['data_id','other_id','type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('acl_data_others');
    }
}
