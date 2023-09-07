<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->foreign(['event_types_id'], 'events_ibfk_1')->references(['id'])->on('event_types');
            $table->foreign(['employees_id'], 'events_ibfk_3')->references(['id'])->on('employees');
            $table->foreign(['clients_id'], 'events_ibfk_2')->references(['id'])->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('events_ibfk_1');
            $table->dropForeign('events_ibfk_3');
            $table->dropForeign('events_ibfk_2');
        });
    }
};
