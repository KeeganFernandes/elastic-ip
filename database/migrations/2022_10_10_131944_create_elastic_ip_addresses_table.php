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
            $table->bigInteger("ip_address");
            $table->uuid("customer_id")->index();
            $table->uuid("subscription_id")->index();
            $table->string("name");
            $table->string("ptr_record")->nullable();
            $table->boolean("suspended")->default(false);
            $table->dateTime("cooldown")->nullable();
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
