<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug',255); // slug for sorting
            $table->string('path')->nullable(); // path to full image
            $table->boolean('featured')->nullable(); // path to full image
            $table->longText('thumbnail')->nullable(); // path to thumbnail
            $table->string('extension')->nullable(); // path to full image
            $table->integer('component_id')->nullable(); // post, page, etc
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('media')->insert(
        array(
            'slug'    => 'default',
            'path'    => '/featured/default.jpg',
            'thumbnail'    => '/featured/default.jpg',
            'featured'      => '1',
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
        Schema::dropIfExists('medias');
    }
}
