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
        Schema::create('service_types', function (Blueprint $table) {
            // Composite Primary Key
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('service_type_id');
            $table->primary(['id', 'service_type_id']);

            // Other columns
            $table->string('service_name');
            $table->unsignedBigInteger('service_provider_id');
            $table->integer('service_interval')->nullable();
            $table->text('service_description')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Foreign Key Constraints
            $table->foreign('service_provider_id')->references('id')->on('service_providers')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_types');
    }
};
