<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSomeColumnsOnGuideLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guide_leads', function (Blueprint $table) {
            $table->string('offer_text_1')->nullable()->change();
            $table->string('offer_text_2')->nullable()->change();
            $table->string('offer_text_3')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guide_leads', function (Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            /* alter table */
            DB::statement('ALTER TABLE `guide_leads` MODIFY `offer_text_1` NOT NULL;');
            DB::statement('ALTER TABLE `guide_leads` MODIFY `offer_text_2` NOT NULL;');
            DB::statement('ALTER TABLE `guide_leads` MODIFY `offer_text_3` NOT NULL;');
            /* finally turn foreign key checks back on */
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        });
    }
}
