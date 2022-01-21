<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_logins', function (Blueprint $table) {
            $table->increments('id')->index()->comment('Auto Increament');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('user_id')->nullable();
            $table->enum('type', ['0', '1'])->comment('0->Citizen,1->Admin')->nullable();
            $table->string('state')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        DB::table('user_logins')->insert(array(
            array('email' => 'Sefali@gmail.com', 'password' => '$2y$10$v9fgp32AJN/rDfJyYABRueAa9OWVyFQhcXLw57tYoOOy3MeV3oHtu', 'user_id' => '6'),
            array('email' => 'Hardik@gmail.com', 'password' => '$2y$10$v9fgp32AJN/rDfJyYABRueAa9OWVyFQhcXLw57tYoOOy3MeV3oHtu', 'user_id' => '3')
            /*             array('email' => 'Assam', 'password' => '18', 'user_id' => ''),
            array('email' => 'Goa', 'password' => '30', 'user_id' => ''),
            array('email' => 'Maharashtra', 'password' => '27', 'user_id' => ''),
            array('email' => 'Punjab', 'password' => '03', 'user_id' => ''),
            array('email' => 'Rajasthan', 'password' => '08', 'user_id' => '') */
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_logins');
    }
}
