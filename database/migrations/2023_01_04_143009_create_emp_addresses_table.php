<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_addresses', function (Blueprint $table) {
            $table->integer('emp_id')->unsigned();
            $table->string('address');
            $table->timestamps();
        });

        Schema::table('emp_addresses', function (Blueprint $table) {
            //Relationships
            $table->foreign('emp_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emp_addresses');
    }
}
