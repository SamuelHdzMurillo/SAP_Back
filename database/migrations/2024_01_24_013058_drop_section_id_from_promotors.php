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
        Schema::table('promotors', function (Blueprint $table) {
            $table->dropConstrainedForeignId("section_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promotors', function (Blueprint $table) {
            $table->foreignId("section_id")->nullable()->constrained('sections');
        });
    }
};
