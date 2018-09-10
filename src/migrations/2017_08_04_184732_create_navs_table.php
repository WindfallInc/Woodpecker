<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (Schema::hasTable('navs')) {
    //
      }
      else{
        Schema::defaultStringLength(191);
        Schema::create('navs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->string('slug',255); // slug for sorting
            $table->string('url')->default('/#'); // http://  or /route
            $table->string('target')->default('_self'); // _blank
            $table->integer('parent_id')->nullable(); // The menu item this belongs to
            $table->integer('menu_id')->nullable(); // the menu this item belongs to
            $table->timestamps();
        });
      }
  }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navs');
    }
}
