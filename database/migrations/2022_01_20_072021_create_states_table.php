<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id')->index()->comments('Auto increment');
            $table->string('name')->nullable();
            $table->string('state_code')->nullable();
            $table->timestamps();
        });
        DB::table('states')->insert(array(
            array('name' => 'Gujarat', 'state_code' => '24'),
            array('name' => 'Delhi', 'state_code' => '07'),
            array('name' => 'Assam', 'state_code' => '18'),
            array('name' => 'Goa', 'state_code' => '30'),
            array('name' => 'Maharashtra', 'state_code' => '27'),
            array('name' => 'Punjab', 'state_code' => '03'),
            array('name' => 'Rajasthan', 'state_code' => '08')
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
