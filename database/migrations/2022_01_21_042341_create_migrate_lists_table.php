<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMigrateListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('migrate_lists', function (Blueprint $table) {
            $table->increments('id')->index()->comment('Auto Increment');
            $table->string('user_id')->nullable();
            $table->string('migrate_state_id')->nullable();
            $table->enum('status', ['Approved', 'Disapproved'])->default('Disapproved');
            $table->string('approved_by')->nullable();
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
        Schema::dropIfExists('migrate_lists');
    }
}
