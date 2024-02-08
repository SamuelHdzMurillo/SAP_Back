<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promoteds', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("second_name");
            $table->string("last_name");
            $table->string("phone_number");
            $table->string("email")->nullable();
            $table->string("section");
            $table->string("adress");
            $table->string("colony");
            $table->string("postal_code");
            $table->string("house_number");
            $table->string("electoral_key")->nullable();
            $table->string("curp")->nullable();
            $table->string("latitude");
            $table->string("longitude");
            $table->foreignId("section_id")->constrained();
            $table->foreignId("promotor_id")->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promoteds');
    }
};
