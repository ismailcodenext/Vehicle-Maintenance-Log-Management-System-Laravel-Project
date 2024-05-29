<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('license_number')->unique();
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->text('address');
            $table->date('date_of_birth');
            $table->date('license_expiry_date');
            $table->boolean('medical_clearance_status');
            $table->text('driving_history');
            $table->string('image')->nullable();
            $table->enum('status', ['Active', 'Pending'])->default('Pending');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
