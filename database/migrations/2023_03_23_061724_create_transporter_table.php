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
        Schema::create('transporter', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->bigInteger('phonenum');
            $table->string('email');
            $table->string('companyname');
            $table->string('remarks');
            $table->string('platenumber');
            $table->string('city');
            $table->string('address');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transporter');
    }
};