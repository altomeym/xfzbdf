<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnsToAmongMyBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('among_my_brands', function (Blueprint $table) {
            $table->string('about_my_work',255)->after('name');
            $table->date('start_date')->after('about_my_work');
            $table->date('end_date')->after('start_date');
            $table->string('about_brand',255)->after('end_date');
            $table->string('industry',255)->nullable()->after('about_brand');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('among_my_brands', function (Blueprint $table) {
            $table->dropColumn('about_my_work');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('about_brand');
            $table->dropColumn('industry');
        });
    }
}
