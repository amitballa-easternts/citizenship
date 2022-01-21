<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitizensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizens', function (Blueprint $table) {
            $table->increments('id')->index()->comment('AUTO_INCREMENT');
            $table->string('first_name')->nullable();
            $table->string('lastname')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->enum('gender', ['0', '1'])->comment('0->Female,1->Male')->nullable();
            $table->string('aadhar_card')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });


        DB::table('citizens')->insert(array(
            array('first_name' => 'Sachin', 'lastname' => 'Tendulkar', 'country' => '1', 'state' => '1', 'city' => 'Gandevi', 'pincode' => '123456', 'gender' => '1', 'aadhar_card' => '123456789011', 'mobile_number' => '1234567890', 'email' => 'Sachin@gmail.com', 'password' => '$2y$10$v9fgp32AJN/rDfJyYABRueAa9OWVyFQhcXLw57tYoOOy3MeV3oHtu'),
            array('first_name' => 'Yuvraj', 'lastname' => 'Singh', 'country' => '1', 'state' => '2', 'city' => 'Surat', 'pincode' => '123456', 'gender' => '1', 'aadhar_card' => '123456789012', 'mobile_number' => '1234567890', 'email' => 'Yuvraj@gmail.com', 'password' => '$2y$10$v9fgp32AJN/rDfJyYABRueAa9OWVyFQhcXLw57tYoOOy3MeV3oHtu'),
            array('first_name' => 'Hardik', 'lastname' => 'Pandya', 'country' => '1', 'state' => '2', 'city' => 'Vadodra', 'pincode' => '123456', 'gender' => '1', 'aadhar_card' => '123456789013', 'mobile_number' => '1234567890', 'email' => 'Hardik@gmail.com', 'password' => '$2y$10$v9fgp32AJN/rDfJyYABRueAa9OWVyFQhcXLw57tYoOOy3MeV3oHtu'),
            array('first_name' => 'Smriti', 'lastname' => 'Mandhana', 'country' => '1', 'state' => '3', 'city' => 'Kutch', 'pincode' => '123456', 'gender' => '0', 'aadhar_card' => '123456789014', 'mobile_number' => '1234567890', 'email' => 'Smriti@gmail.com', 'password' => '$2y$10$v9fgp32AJN/rDfJyYABRueAa9OWVyFQhcXLw57tYoOOy3MeV3oHtu'),
            array('first_name' => 'Irfan', 'lastname' => 'Pathan', 'country' => '1', 'state' => '4', 'city' => 'Anand', 'pincode' => '123456', 'gender' => '1', 'aadhar_card' => '123456789015', 'mobile_number' => '1234567890', 'email' => 'Irfan@gmail.com', 'password' => '$2y$10$v9fgp32AJN/rDfJyYABRueAa9OWVyFQhcXLw57tYoOOy3MeV3oHtu'),
            array('first_name' => 'Sefali', 'lastname' => 'Verma', 'country' => '1', 'state' => '3', 'city' => 'Botad', 'pincode' => '123456', 'gender' => '0', 'aadhar_card' => '123456789016', 'mobile_number' => '1234567890', 'email' => 'Sefali@gmail.com', 'password' => '$2y$10$v9fgp32AJN/rDfJyYABRueAa9OWVyFQhcXLw57tYoOOy3MeV3oHtu'),
            array('first_name' => 'Shardul', 'lastname' => 'Thakur', 'country' => '1', 'state' => '2', 'city' => 'Navsari', 'pincode' => '123456', 'gender' => '1', 'aadhar_card' => '123456789017', 'mobile_number' => '1234567890', 'email' => 'Shardul@gmail.com', 'password' => '$2y$10$v9fgp32AJN/rDfJyYABRueAa9OWVyFQhcXLw57tYoOOy3MeV3oHtu'),
            array('first_name' => 'Mithali', 'lastname' => 'Raj', 'country' => '1', 'state' => '3', 'city' => 'Pandesara', 'pincode' => '123456', 'gender' => '0', 'aadhar_card' => '123456789018', 'mobile_number' => '1234567890', 'email' => 'Mithali@gmail.com', 'password' => '$2y$10$v9fgp32AJN/rDfJyYABRueAa9OWVyFQhcXLw57tYoOOy3MeV3oHtu'),
            array('first_name' => 'Poonam', 'lastname' => 'Yadav', 'country' => '1', 'state' => '3', 'city' => 'Althan', 'pincode' => '123456', 'gender' => '0', 'aadhar_card' => '123456789019', 'mobile_number' => '1234567890', 'email' => 'Poonam@gmail.com', 'password' => '$2y$10$v9fgp32AJN/rDfJyYABRueAa9OWVyFQhcXLw57tYoOOy3MeV3oHtu'),
            array('first_name' => 'Yuzvendra', 'lastname' => 'Chahal', 'country' => '1', 'state' => '2', 'city' => 'Ameziya', 'pincode' => '123456', 'gender' => '1', 'aadhar_card' => '123456789020', 'mobile_number' => '1234567890', 'email' => 'Yuzvendra@gmail.com', 'password' => '$2y$10$v9fgp32AJN/rDfJyYABRueAa9OWVyFQhcXLw57tYoOOy3MeV3oHtu')
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citizens');
    }
}
