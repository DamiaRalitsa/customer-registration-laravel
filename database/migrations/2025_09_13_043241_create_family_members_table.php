<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('family_list', function (Blueprint $table) {
            $table->integer('ft_id')->primary();
            $table->integer('cst_id');
            $table->string('ft_relation', 50);
            $table->string('ft_name', 50);
            $table->string('ft_dob', 50); // VARCHAR as in your schema
            
            $table->foreign('cst_id')->references('cst_id')->on('customer');
        });
    }

    public function down()
    {
        Schema::dropIfExists('family_list');
    }
};