<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $table = "blog_post_tags";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_post_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('blog_post_id')->index();
            $table->foreign('blog_post_id')->references('id')
            ->on('blog_posts')
            ->onDelete('cascade');
            $table->unsignedInteger('tag_id')->index();
            $table->foreign('tag_id')->references('id')
            ->on('tags')
            ->onDelete('cascade');
            $table->timestamps();
            // dd($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_post_tags');
    }
};
