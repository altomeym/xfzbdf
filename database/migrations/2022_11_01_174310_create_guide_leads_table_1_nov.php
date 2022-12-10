<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuideLeadsTable1Nov extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guide_leads', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->integer('pages')->nullable();
            $table->string('type')->comment('pdf or video');
            $table->string('link');
            $table->string('offer_text_1');
            $table->string('offer_text_2');
            $table->string('offer_text_3');
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
        Schema::dropIfExists('guide_leads');
    }
}
