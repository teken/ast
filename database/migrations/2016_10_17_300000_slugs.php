<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Slugs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('courses', function ($table) {
        $table->string('slug')->unique();
      });
      Schema::table('modules', function ($table) {
        $table->string('slug')->unique();
      });
      Schema::table('videos', function ($table) {
        $table->string('slug')->unique();
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
        $table->dropColumn('slug');
      });
      Schema::table('modules', function ($table) {
        $table->dropColumn('slug');
      });
      Schema::table('videos', function ($table) {
        $table->dropColumn('slug');
      });
    }
}
