<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_custom_field_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->string('field_key');
            $table->text('value')->nullable();
            $table->timestamps();

            $table->unique(['business_id', 'field_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_custom_field_values');
    }
};
