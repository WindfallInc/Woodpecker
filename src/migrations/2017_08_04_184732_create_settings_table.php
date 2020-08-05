<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255);
            $table->text('content');
            $table->text('content2');
            $table->text('content3');
            $table->timestamps();
        });
        DB::table('settings')->insert(
        array(
            'name'        => 'Site Url',
            'content'     => 'https://yoursite.com',
        )
        );
        DB::table('settings')->insert(
        array(
            'name'        => 'Notifications',
            'content'     => 'false',
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
        Schema::dropIfExists('settings');
    }
}
