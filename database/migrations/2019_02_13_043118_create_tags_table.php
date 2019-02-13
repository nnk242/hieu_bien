<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tag');
            $table->string('tag_seo');
            $table->enum('type', ['post','home'])->default('post');
            $table->enum('status', ['hide','show'])->default('show');
            $table->timestamps();
        });
        //init category
        \Illuminate\Support\Facades\DB::table('tags')->insert([
            [
                'tag' => 'nha khoa, thẩm mỹ, Việt Đức, Nha khoa thẩm mỹ, Thẩm mỹ Việt Đức, Nha khoa thẩm mỹ Việt Đức, nhakhoathammyvietduc.vn',
                'tag_seo' => str_seo('nha khoa') . ',' . str_seo('thẩm mỹ')
                    . ',' . str_seo('Việt Đức') . ',' . str_seo('Nha khoa thẩm mỹ')
                    . ',' . str_seo('Thẩm mỹ Việt Đức') . ',' . str_seo('Nha khoa thẩm mỹ Việt Đức')
                    . ',' . str_seo('nhakhoathammyvietduc.vn'),
                'type' => 'home',
                'status' => 'show'
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
        Schema::dropIfExists('tags');
    }
}
