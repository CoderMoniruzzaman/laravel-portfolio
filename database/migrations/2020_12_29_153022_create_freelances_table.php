<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreelancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freelances', function (Blueprint $table) {
            $table->id();
            $table->string('feelancesite_name');
            $table->string('feelancesite_image')->default('defaultfeelancephoto.jpg');
            $table->longText('feelancesite_description');
            $table->string('freelance_url')->default('#');
            $table->string('status')->default(0);
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
        Schema::dropIfExists('freelances');
    }
}
