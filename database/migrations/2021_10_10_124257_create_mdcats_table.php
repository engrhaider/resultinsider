<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMdcatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mdcats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('roll_no');
            $table->string('name');
            $table->string('cnic');
            $table->integer('marks');
            $table->index('name', 'name_idx');
            $table->unique('cnic', 'unique_cnic_idx');
            $table->unique('roll_no', 'unique_roll_no_idx');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mdcats');
    }
}
