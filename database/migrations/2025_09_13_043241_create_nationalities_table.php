<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('nationality', function (Blueprint $table) {
            $table->integer('nationality_id')->primary();
            $table->string('nationality_name', 50);
            $table->char('nationality_code', 2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('nationality');
    }
};