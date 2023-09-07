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
        Schema::create('events', function (Blueprint $table) {
            $table->integer('id', true);
            $table->dateTime('start_time');
            $table->dateTime('finish_time');
            $table->boolean('offsite')->nullable()->default(false);
            $table->string('note')->nullable();
            $table->dateTime('create_time')->nullable()->useCurrent();
            $table->string('address')->nullable();
            $table->integer('event_types_id')->nullable()->index('event_types_id');
            $table->integer('clients_id')->index('clients_id');
            $table->integer('employees_id')->nullable()->index('employees_id');
            $table->dateTime('update_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
