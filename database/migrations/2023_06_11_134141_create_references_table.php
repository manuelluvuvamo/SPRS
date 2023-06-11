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
        Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->double("amount");
            $table->timestamp("end_datetime");
            $table->unsignedBigInteger("reference_id")->unique()->unsigned();
            $table->unsignedBigInteger('id_entity');
            $table->foreign('id_entity')->references('id')->on('entities')->onDelete('cascade');
            $table->unsignedBigInteger("entity_code")->nullable();
            $table->string('status')->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('references');
    }
};
