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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Bank BCA", "QRIS Dana"
            $table->enum('type', ['bank_transfer', 'qris', 'cash'])->default('bank_transfer');
            $table->string('account_number')->nullable(); // For bank transfer
            $table->string('account_name')->nullable(); // Account holder name
            $table->string('qr_code_image')->nullable(); // Path to QR code image
            $table->text('instructions')->nullable(); // Additional instructions
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
