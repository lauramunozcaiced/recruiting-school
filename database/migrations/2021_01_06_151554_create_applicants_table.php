<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('identification')->unique();
            $table->string('firstname');
            $table->string('lastname');
            $table->text('image');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('linkedin')->nullable();
            $table->text('cv');
            $table->string('location');
            $table->text('aboutme');
            $table->string('title');
            $table->string('visible');
            $table->string('portfolio')->nullable();
            $table->string('video')->nullable();
            $table->string('english');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('position_id')->nullable();
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('set null');
            $table->bigInteger('choose_position')->nullable();
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
        Schema::dropIfExists('applicants');
    }
}
