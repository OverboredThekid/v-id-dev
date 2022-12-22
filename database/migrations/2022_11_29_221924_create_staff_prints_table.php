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
        Schema::create('staff_prints', function (Blueprint $table) {
            $table->id('id');
            $table->string('is_active'); //1
            $table->timestamps();
            $table->foreignUuid('staff_id')
                ->constrained('staff');
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
        Schema::dropIfExists('staff_prints');
    }
};
