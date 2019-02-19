<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFooterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('facebook', 255)->nullable();
            $table->string('icon_facebook', 255)->default('fab fa-facebook-square')->nullable();
            $table->string('email', 255)->nullable();
            $table->string('icon_gmail', 255)->default('fab fa-google')->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('icon_number_phone', 255)->default('fas fa-phone-volume')->nullable();
            $table->string('zalo', 255)->nullable();
            $table->string('icon_zalo', 255)->nullable();
            $table->string('address', 255)->default('fas fa-map-marker-alt')->nullable();
            $table->string('icon_address', 255)->nullable();
            $table->timestamps();
        });
        //init user
        \Illuminate\Support\Facades\DB::table('footer')->insert([
            [
                'facebook' => 'fb.com/nnk242',
                'email' => 'test@test.com',
                'address' => 'Hà Nội',
                'phone' => '+(84) 382 997 997',
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
        Schema::dropIfExists('footer');
    }
}
