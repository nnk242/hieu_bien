<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
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
            $table->integer('user_id');
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
