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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 255);
            $table->string('phone', 20);
            $table->text('address');
            $table->decimal('lat', 20, 7);
            $table->decimal('long', 20, 7);
            $table->string('logo', 255);
            $table->string('zipcode', 20)->nullable();
            $table->string('website', 255);
            $table->string('email', 255)->nullable();
            $table->string('contact_phone', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
