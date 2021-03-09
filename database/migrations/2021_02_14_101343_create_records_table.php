<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
   
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('dob');
            $table->string('civil_status');
            $table->integer('age')->nullable();
            $table->string('gender');
            $table->string('address');
            $table->string('purok');
            $table->string('educational_attainment')->nullable();
            $table->string('occupation')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('category')->nullable();
            $table->string('imageURL')->nullable();
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
        Schema::dropIfExists('records');
    }
}
