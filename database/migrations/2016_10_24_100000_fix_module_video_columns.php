<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixModuleVideoColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('modulevideos', function ($table) {
        $table->dropColumn('user_id');
        //$table->integer('module_id')->unsigned();
        $table->foreign('module_id')->references('id')->on('modules');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('modulevideos', function ($table) {
        //$table->dropColumn('module_id');
        $table->integer('user_id')->unsigned();
        $table->foreign('user_id')->references('id')->on('users');
      });
    }
}
