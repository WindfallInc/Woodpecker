<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('content_media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('content_id');
            $table->integer('media_id');
        });
        DB::table('content_media')->insert(
        array(
            'id'          => 1,
            'content_id'  => 1,
            'media_id'    => 1,
        )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_media');
    }
}
