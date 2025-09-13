<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->integer('cst_id')->primary();
            $table->integer('nationality_id');
            $table->string('cst_name', 50);
            $table->date('cst_dob');
            $table->string('cst_phoneNum', 20);
            $table->string('cst_email', 50);
            
            $table->foreign('nationality_id')->references('nationality_id')->on('nationality');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer');
    }
};