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
        Schema::create('event_types', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->text('description')->nullable();
            $table->dateTime('create_time')->nullable()->useCurrent();
            $table->string('title_color_hex', 9)->nullable();
            $table->string('bg_color_hex', 9)->nullable()->default('NULL');
            $table->integer('default_duration')->nullable()->default(60)->comment('minutes');
            $table->boolean('client_is_not_involved')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_types');
    }
};
