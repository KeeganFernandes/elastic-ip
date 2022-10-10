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
        Schema::create('elastic_ip_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer("ip_address");
            $table->uuid("customer_id");
            $table->uuid("subscription_id");
            $table->string("name");
            $table->string("ptr_record");
            $table->boolean("suspended");
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
        Schema::dropIfExists('elastic_ip_addresses');
    }
};
