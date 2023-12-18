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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('owner_id')->nullable();
            $table->foreign('owner_id')->references('id')->on('admins');

            $table->string('name')->nullable();
            $table->string('slug')->nullable();

            $table->text('description')->nullable();
            $table->text('logo')->nullable();

            $table->string('ico')->nullable();
            $table->string('dic')->nullable();
            $table->string('address')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
