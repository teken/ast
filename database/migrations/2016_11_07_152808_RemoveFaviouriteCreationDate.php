<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFaviouriteCreationDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('userfavorites', function ($table) {
        $table->dropColumn('created_at');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('userfavorites', function ($table) {
        $table->timestamp('created_at');
      });
    }
}
