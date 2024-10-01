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
        Schema::create('agreement_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agreement_id')->constrained();
            $table->string('name');
            $table->string('description');
            $table->integer('quantity');
            $table->integer('cost_price');
            $table->integer('retail_price');
            $table->timestamp('voided_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreement_items');
    }
};
