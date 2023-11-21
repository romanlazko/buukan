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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->on('clients')->references('id');

            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->on('employees')->references('id');

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->on('services')->references('id');

            $table->date('date')->nullable();

            $table->time('term')->nullable();

            $table->string('comment')->nullable();

            $table->integer('price')->nullable();

            $table->string('status')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
