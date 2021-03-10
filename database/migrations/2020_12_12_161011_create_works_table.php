<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->longText('project_description');
            $table->integer('category_id');
            $table->string('project_image')->default('defaultprojectphoto.jpg');
            $table->string('slider_image')->default(json_encode(['defaultsliderphoto.jpg']));
            $table->string('client_link')->nullable();
            $table->string('project_link')->nullable();
            $table->string('project_status')->default(0);
            $table->string('project_video_link')->nullable();
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
        Schema::dropIfExists('works');
    }
}
