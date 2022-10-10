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
        Schema::create('access_concentrator_ip_pool', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("ip_pool_id");
            $table->bigInteger("access_concentrator_id");
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
        Schema::dropIfExists('access_concentrator_ip_pool');
    }
};
