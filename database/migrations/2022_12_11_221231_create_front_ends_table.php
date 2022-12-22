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
        Schema::create('front_ends', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->string('slug');
            $table->text('content');
            $table->string('auther');
            $table->string('is_active'); //1
            $table->string('is_index'); // can only be 1

            //SEO add layer

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
        Schema::dropIfExists('front_ends');
    }
};
