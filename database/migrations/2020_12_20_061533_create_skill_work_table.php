<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_work', function (Blueprint $table) {
            $table->unsignedBigInteger('work_id');
            $table->unsignedBigInteger('skill_id');
        });
        Schema::table('skill_work', function($table)
        {
            $table->foreign('work_id')->references('id')->on('works')->onDelete('cascade');
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skill_work');
    }
}
