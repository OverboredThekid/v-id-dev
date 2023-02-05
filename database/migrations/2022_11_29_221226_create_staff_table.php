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
        Schema::create('staff', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name'); //1
            $table->string('email'); //1
            $table->string('phone'); //1
            $table->boolean('is_active'); //2
            $table->integer('id_count')->nullable(); //2
            $table->timestamps();
        });
    }

    protected $attributes = array(
        'is_active' => '1'
      );
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
};
