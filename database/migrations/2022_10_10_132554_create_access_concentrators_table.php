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
        Schema::create('access_concentrators', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->uuid("site_id")->index();
            $table->uuid("customer_id")->nullable()->index();
            $table->uuid("subscription_id")->index();
            $table->string("radius_secret");
            $table->string("radius_src_address");
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
        Schema::dropIfExists('access_concentrators');
    }
};
