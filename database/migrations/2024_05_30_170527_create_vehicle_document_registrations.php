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
        Schema::create('vehicle_document_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('registration_number');
            $table->string('registration_expiry_date');
            $table->string('insurance_number')->nullable();
            $table->string('insurance_expiry_date')->nullable();
            $table->string('tax_token_number');
            $table->string('tax_token_expiry_date');
            $table->string('fitness_certificate_number');
            $table->string('fitness_certificate_expiry_date');
            $table->string('permit_number');
            $table->string('permit_expiry_date');
            $table->string('road_worthiness_certificate_number')->nullable();
            $table->string('road_worthiness_certificate_expiry_date')->nullable();
            $table->string('emission_test_certificate_number')->nullable();
            $table->string('emission_test_certificate_expiry_date')->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['Active', 'Pending'])->default('Pending');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_document_registrations');
    }
};
