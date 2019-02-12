<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image', 255)->nullable();
            $table->string('title', 255);
            $table->string('title_seo', 255)->unique();
            $table->longText('introduce');
            $table->longText('content');
            $table->string('author', 30);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['hide', 'show'])->default('show');
            $table->integer('view')->default(0);
            $table->timestamps();
        });

        //init category
        \Illuminate\Support\Facades\DB::table('categories')->insert([
            [
                'title' => 'test',
                'title_seo' => 'test',
                'introduce' => 'Admin',
                'content' => 'Admin',
                'author' => 'Admin',
                'user_id' => 1,
                'status' => 'show',
            ]
        ]);
        //posts
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image', 255)->nullable();
            $table->string('title', 255);
            $table->string('title_seo', 255)->unique();
            $table->longText('introduce');
            $table->longText('content');
            $table->string('author', 30);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->enum('status', ['hide', 'show'])->default('show');
            $table->enum('slide', ['hide', 'show'])->default('hide');
            $table->integer('view')->default(0);
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
        Schema::dropIfExists('categories');
        Schema::dropIfExists('posts');
    }
}
