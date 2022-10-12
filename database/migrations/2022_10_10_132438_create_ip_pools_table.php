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
        Schema::create('ip_pools', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index()->unique();
            $table->bigInteger("range_start");
            $table->bigInteger("range_end");
            $table->uuid("customer_id")->index()->nullable();
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
        Schema::dropIfExists('ip_pools');
    }
};
