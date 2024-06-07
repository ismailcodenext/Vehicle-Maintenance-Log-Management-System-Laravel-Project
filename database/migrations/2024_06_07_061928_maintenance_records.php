









<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('maintenance_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->date('date_of_service');
            $table->integer('mileage_at_service');
            $table->unsignedBigInteger('service_type_id');
            $table->unsignedBigInteger('service_provider_type_id');
            $table->text('description_of_service')->nullable();
            $table->decimal('cost', 10, 2)->nullable();
            $table->string('image_upload')->nullable();
            $table->unsignedBigInteger('user_id');


            $table->foreign('vehicle_id')->references('id')->on('vehicles')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('service_type_id')->references('id')->on('service_types')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('service_provider_type_id')->references('id')->on('service_providers')->restrictOnDelete()->cascadeOnUpdate();

            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete()->cascadeOnUpdate();


            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('maintenance_records');
    }
};


