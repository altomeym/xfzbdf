<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryWiseWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_wise_websites', function (Blueprint $table) {
            $table->id();
            $table->integer('country_id')->unsigned();
            $table->string('website');
            $table->foreign('country_id')->references('id')->on('countries'); 
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
        Schema::dropIfExists('country_wise_websites');
    }
}
