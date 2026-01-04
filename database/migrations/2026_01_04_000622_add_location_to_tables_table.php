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
        Schema::table('tables', function (Blueprint $table) {
            $table->decimal('location_lat', 10, 8)->nullable()->after('qr_code_path');
            $table->decimal('location_lng', 11, 8)->nullable()->after('location_lat');
            $table->integer('location_radius')->default(10)->after('location_lng');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            $table->dropColumn(['location_lat', 'location_lng', 'location_radius']);
        });
    }
};
