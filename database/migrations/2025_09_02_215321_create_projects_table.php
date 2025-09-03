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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // English fields
            $table->string('en_name');
            $table->string('en_location')->nullable();
            $table->text('en_scope')->nullable();
            $table->text('en_objective')->nullable();

            // Arabic fields
            $table->string('ar_name');
            $table->string('ar_location')->nullable();
            $table->text('ar_scope')->nullable();
            $table->text('ar_objective')->nullable();

            // Image
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
