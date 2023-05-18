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
        Schema::create('scheduledwaste', function (Blueprint $table) {
            $table->id();
            $table->string('wastecode');
            $table->bigInteger('weight');
            $table->string('wastedescription');
            $table->string('disposalsite');
            $table->string('wastetype');
            $table->string('packaging');
            $table->string('state');
            $table->string('statusDisposal');
            $table->date('wasteDate');
            $table->string('pic');
            $table->date('expiredDate');
            $table->string('transporter');
            $table->string('diff')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduledwaste');
    }
};
