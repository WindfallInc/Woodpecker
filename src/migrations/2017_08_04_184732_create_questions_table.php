<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title'); // wll double as placeholder text in the question
            $table->string('slug',255); // slug for sorting
            $table->string('type',255)->nullable(); // Type of question, IE template question, checkbox, input text, email
            $table->string('placeholder',255)->nullable(); // Optional Placeholder Text
            $table->string('columns',255)->nullable(); // Optional Placeholder Text
            $table->integer('columnInt')->nullable(); // Optional Placeholder Text
            $table->integer('order')->nullable(); // the form that this question belong to
            $table->integer('form_id')->nullable(); // the form that this question belong to
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('questions')->insert(
        array(
            'title'           => 'Text Input',
            'slug'            => 'text-input',
            'type'            => 'template',
            'placeholder'     => '',
        )
        );
        DB::table('questions')->insert(
        array(
            'title'           => 'Date Input',
            'slug'            => 'date-input',
            'type'            => 'template',
            'placeholder'     => '',
        )
        );
        DB::table('questions')->insert(
        array(
            'title'           => 'Text area',
            'slug'            => 'text-area',
            'type'            => 'template',
            'placeholder'     => '',
        )
        );
        DB::table('questions')->insert(
        array(
            'title'           => 'Email Input',
            'slug'            => 'email-input',
            'type'            => 'template',
            'placeholder'     => '',
        )
        );
        DB::table('questions')->insert(
        array(
            'title'           => 'Number Input',
            'slug'            => 'text-input',
            'type'            => 'template',
            'placeholder'     => '',
        )
        );
        DB::table('questions')->insert(
        array(
            'title'           => 'Checkbox',
            'slug'            => 'checkbox',
            'type'            => 'template',
            'placeholder'     => '',
        )
        );
        DB::table('questions')->insert(
        array(
            'title'           => 'Radio Button',
            'slug'            => 'radio-button',
            'type'            => 'template',
            'placeholder'     => '',
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
        Schema::dropIfExists('forms');
    }
}
