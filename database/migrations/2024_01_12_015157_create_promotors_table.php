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
        Schema::create('promotors', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email")->unique()->nullable();
            $table->string("phone_number")->unique()->nullable();
            $table->string("position");
            $table->string("profile_path");
            $table->string("ine_path")->nullable();
            $table->string("username");
            $table->string('password');
            $table->rememberToken();
            $table->foreignId("municipal_id")->constrained();
            $table->foreignId("section_id")->constrained('sections');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotors');
    }
};
