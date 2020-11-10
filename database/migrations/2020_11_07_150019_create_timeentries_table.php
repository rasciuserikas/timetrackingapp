<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeentries', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title', 255);
            $table->longText('comment')->nullable();
            $table->date('date')->nullable();
            $table->integer('timespent');
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
        Schema::dropIfExists('timeentries');
    }
}
