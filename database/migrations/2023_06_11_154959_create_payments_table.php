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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->double("amount");
            $table->unsignedBigInteger("reference_id")->unique()->unsigned();
            $table->unsignedBigInteger('id_reference');
            $table->foreign('id_reference')->references('id')->on('references')->onDelete('cascade');
            $table->unsignedBigInteger("entity_code")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
