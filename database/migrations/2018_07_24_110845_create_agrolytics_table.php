<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgrolyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrolytics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pag_objective')->nullable();
            $table->string('prospect');
            $table->string('comp_objective')->nullable();
            $table->string('status');
            $table->string('prog_status')->default('Pending');
            $table->string('initiative');
            $table->integer('cat_id');
            $table->integer('user_id')->nullable();
            $table->integer('op_rep')->nullable();
            $table->date('day_of_week')->nullable();
            $table->string('lmodified_id')->nullable();

            $table->timestamps();

            // 'pag_objective','prospect','status','initiative','user_id','op_rep','day_of_week'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agrolytics');
    }
}
