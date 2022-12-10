<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopAppearancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_appearances', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_id');
            $table->string('heading_text')->default('freelancer');
            $table->text('popular_links',1000)->nullable();
            $table->text('slider_links',2000)->nullable();
            $table->string('info_section_heading')->nullable()->default('A business solution designed for teams');
            $table->string('info_section_paragraph',255)->nullable()->default('Upgrade to a curated experience packed with tools and benefits, dedicated to businesses');
            $table->text('info_section_bullets',1000)->nullable()->default(json_encode(['Connect to freelancers with proven business experience','Get matched with the perfect talent by a customer success manager','Manage teamwork and boost productivity with one powerful workspace']));
            $table->string('info_section_banners')->nullable();//->default();
            $table->string('hot_product')->nullable();
            $table->string('featured_products')->nullable();
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
        Schema::dropIfExists('shop_appearances');
    }
}
