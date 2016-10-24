<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Urls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('courses', function ($table) {
        $table->dropColumn('url');
      });
      Schema::table('modules', function ($table) {
        $table->dropColumn('url');
      });
      Schema::table('videos', function ($table) {
        $table->dropColumn('url');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('courses', function ($table) {
        $table->string('url');
      });
      Schema::table('modules', function ($table) {
        $table->string('url');
      });
      Schema::table('videos', function ($table) {
        $table->string('url');
      });
    }
}
