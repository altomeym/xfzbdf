<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMessageUidToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumns('messages', ['message_uid'])) {
            Schema::table('messages', function (Blueprint $table) {
                $table->string('message_uid')->nullable()->after('id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumns('orders', ['message_uid'])) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('message_uid');
            });
        }
    }
}
