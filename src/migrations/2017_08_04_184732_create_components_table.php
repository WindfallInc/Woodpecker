<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('components', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->string('slug',255); // slug for sorting
            $table->string('image')->nullable(); // image
            $table->longText('content1')->nullable(); // content in component section1
            $table->longText('content2')->nullable(); // content in component section2
            $table->longText('content3')->nullable(); // content in component section3
            $table->longText('content4')->nullable(); // content in component section4
            $table->longText('content5')->nullable(); // content in component section5
            $table->longText('content6')->nullable(); // content in component section6
            $table->integer('form_id')->nullable(); // Does this type of component require a form?
            $table->string('outside')->nullable(); // If on - link target="_blank" set
            $table->integer('content_id')->nullable(); // content relation
            $table->integer('order')->nullable(); // control the order in which components are loaded ->  content->components->orderBy('order')->get();
            $table->integer('type_id')->nullable(); // content relation
            $table->integer('category_id')->nullable(); // content relation
            $table->integer('reqimg')->nullable(); // Does this type of component require an image?
            $table->string('columns')->nullable(); // How many columns will this component take up - three, four, twelve, etc
            $table->string('template')->nullable(); // loop, insert, static
            $table->string('link_target')->nullable(); // Specify if component will have a link that needs to be targeted
            $table->integer('type_selection')->nullable(); // content relation
            $table->integer('category_selection')->nullable(); // content relation
            $table->integer('dynamic')->nullable(); // lets the controller know a component is dynamic
            $table->integer('parent_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('components')->insert(
        array(
            'title'    => 'Page Break',
            'slug'     => 'page-break',
            'columns'  => 'twelve',
            'template'     => '1'
        )
        );
        DB::table('components')->insert(
        array(
            'title'    => 'Featured',
            'slug'     => 'featured',
            'content1'   => '<input type="text" name="input1[]" placeholder="Business">',
            'content2'   => '<input type="text" name="input2[]" placeholder="Blurb">',
            'content3'   => '<content-bar></content-bar><div class="transfer"><div class="textarea active" contenteditable="true" ></div><input type="text" name="input3[]" class="codearea"></div>',
            'content4'   => '<input type="text" name="input4[]" placeholder="Link Url">',
            'content5'   => '<input type="text" name="input5[]" placeholder="Link CTA">',
            'columns'  => 'four',
            'reqImg'   => '1',
            'template'     => '1',
            'link_target' => 1,
            'outside'  => 'off',
            'parent_id' => 1
        )
        );
        DB::table('components')->insert(
        array(
            'title'    => 'Fancy List',
            'slug'     => 'fancy-list',
            'content1'   => '<input type="text" name="input1[]" placeholder="title">',
            'content2'   => '<content-bar></content-bar><div class="transfer"><div class="textarea active" contenteditable="true" ><ul><li></li></ul></div><input type="text" name="input2[]" class="codearea"></div>',
            'columns'  => 'four',
            'template'     => '1',
            'parent_id' => 2
        )
        );
        DB::table('components')->insert(
        array(
            'title'    => 'Story',
            'slug'     => 'story',
            'content1'   => '<input type="text" name="input1[]" placeholder="Title">',
            'content2'   => '<content-bar></content-bar><div class="transfer"><div class="textarea active" contenteditable="true" ></div><input type="text" name="input2[]" class="codearea"></div>',
            'columns'  => 'six',
            'reqImg'   => '1',
            'template'     => '1',
            'parent_id' => 3
        )
        );
        DB::table('components')->insert(
        array(
            'title'    => 'Gallery',
            'slug'     => 'gallery',
            'content1'   => '<input type="text" name="input1[]" placeholder="Flic.kr url">',
            'content2'   => '<input type="text" name="input2[]" placeholder="Title">',
            'columns'  => 'six',
            'reqImg'   => '1',
            'template'     => '1',
            'parent_id' => 4
        )
        );
        DB::table('components')->insert(
        array(
            'title'    => 'Shoutout Link',
            'slug'     => 'fancy-link',
            'content1'   => '<input type="text" name="input1[]" placeholder="Link URL">',
            'content2'   => '<input type="text" name="input2[]" placeholder="Link Text">',
            'columns'  => 'twelve',
            'template'     => '1',
            'link_target' => '1',
            'outside'  => 'off',
            'parent_id' => 5
        )
        );
        DB::table('components')->insert(
        array(
            'title'    => 'Carousal',
            'slug'     => 'carousal',
            'content1'   => '<input type="text" name="input1[]" placeholder="Full Gallery url">',
            'content2'   => '<input type="text" name="input2[]" placeholder="Link Text">',
            'reqImg'   => '1',
            'columns'  => 'six',
            'template'     => '1',
            'link_target' => '1',
            'outside'  => 'off',
            'image' => '/component/carousal-component.jpg',
            'parent_id' => 6
        )
        );
        DB::table('components')->insert(
        array(
            'title'    => 'Questionair',
            'slug'     => 'questionair',
            'columns'  => 'twelve',
            'template'     => '1',
            'parent_id' => 7
        )
        );
        DB::table('components')->insert(
        array(
            'title'    => 'Google Map',
            'slug'     => 'google-map',
            'columns'  => 'six',
            'template'     => '1',
            'content1'   => '<input type="text" name="input1[]" placeholder="Google Iframe Code">',
            'parent_id' => 8
        )
        );
        DB::table('components')->insert(
        array(
            'title'    => 'Youtube Video',
            'slug'     => 'youtube-video',
            'columns'  => 'six',
            'template'     => '1',
            'content1'   => '<input type="text" name="input1[]" placeholder="Youtube Link">',
            'parent_id' => 9
        )
        );

        /*
        DB::table('components')->insert(
        array(
            'title'    => 'Blog Post CTA',
            'slug'     => 'post-display',
            'columns'  => 'twelve',
            'type'     => 'template'
        )
        );
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('components');
    }
}
