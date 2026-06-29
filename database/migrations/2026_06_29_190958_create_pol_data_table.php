<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pol_data', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['Approve', 'Reject'])->default('Approve');
            $table->date('booking_date')->nullable();
            $table->string('consignee')->nullable();
            $table->string('sales')->nullable();
            $table->string('kode_origin', 20)->nullable();
            $table->string('origin')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pol_data');
    }
};
