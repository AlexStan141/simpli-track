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
            $table->string('name');
            $table->string('address');
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')
                ->references('id')->on('currencies')
                ->onDelete('set null');
            $table->foreignId('due_day_id')->constrained()->onDelete('cascade');
            $table->foreignId('invoice_for_attention_id')->nullable()->onDelete('cascade');
            $table->boolean('display_invoice_amount');
            $table->string('logo')->nullable();
            $table->timestamps();
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
