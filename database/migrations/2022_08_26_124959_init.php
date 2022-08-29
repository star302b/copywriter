<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('admin.database.users_table'), function(Blueprint $table) {
            $table->id('id')->change();
        });

        Schema::create('requests', function (Blueprint $table) {
            $table->id();

            $table->text('name');
            $table->text('description');
            $table->text('geo');
            $table->tinyInteger('status')->nullable();

            $table->text('comments');

            $table->bigInteger('link_builder_id')->unsigned()->nullable();
            $table->foreign('link_builder_id')->references('id')->on(config('admin.database.users_table'));

            $table->bigInteger('editor_id')->unsigned()->nullable();
            $table->foreign('editor_id')->references('id')->on('admin_users');

            $table->bigInteger('writer_id')->unsigned()->nullable();
            $table->foreign('writer_id')->references('id')->on('admin_users');

            $table->timestamps();

        });

        Schema::create('contents', function (Blueprint $table) {

            $table->id();

            $table->text('title')->nullable();
            $table->longText('content')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->integer('word_count')->nullable();
            $table->integer('require_words')->nullable();
            $table->tinyInteger('count_filled')->nullable();
            $table->text('url')->nullable();
            $table->text('geo')->nullable();
            $table->text('live_url')->nullable();
            $table->text('site_url')->nullable();
            $table->tinyInteger('copy_scape_check')->nullable();
            $table->tinyInteger('approved')->nullable();

            $table->bigInteger('writer_id')->unsigned()->nullable();
            $table->foreign('writer_id')->references('id')->on('admin_users');

            $table->bigInteger('editor_id')->unsigned()->nullable();
            $table->foreign('editor_id')->references('id')->on('admin_users');

            $table->timestamps();


        });

        Schema::create('revisions', function (Blueprint $table) {
            $table->id();

            $table->longText('notes')->nullable();

            $table->bigInteger('request_id')->unsigned()->nullable();
            $table->foreign('request_id')->references('id')->on('requests');

            $table->bigInteger('editor_id')->unsigned()->nullable();
            $table->foreign('editor_id')->references('id')->on('admin_users');

            $table->bigInteger('writer_id')->unsigned()->nullable();
            $table->foreign('writer_id')->references('id')->on('admin_users');

            $table->bigInteger('content_id')->unsigned()->nullable();
            $table->foreign('content_id')->references('id')->on('contents');

            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
        Schema::dropIfExists('revisions');
        Schema::dropIfExists('requests');
    }
};
