<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Feature;
use App\Models\Inventory;
use App\Models\FeatureValue;

class CreateFeatureInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Feature::class)->onDelete('cascade');
            $table->foreignIdFor(Inventory::class)->onDelete('cascade');
            $table->foreignIdFor(FeatureValue::class)->onDelete('cascade');
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
        Schema::dropIfExists('feature_inventory');
    }
}
