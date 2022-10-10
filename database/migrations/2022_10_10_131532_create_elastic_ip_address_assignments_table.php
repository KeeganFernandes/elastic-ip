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
        Schema::create('elastic_ip_address_assignments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("elastic_ip_address_id");
            $table->bigInteger("access_concentrator_id");
            $table->uuid("site_id");
            $table->string("username");
            $table->string("password");
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
        Schema::dropIfExists('elastic_ip_address_assignments');
    }
};
