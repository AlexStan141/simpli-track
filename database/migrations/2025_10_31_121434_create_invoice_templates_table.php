<?php

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\DueDay;
use App\Models\InvoiceForAttention;
use App\Models\InvoiceTemplate;
use App\Models\Landlord;
use App\Models\Region;
use App\Models\Status;
use App\Models\User;
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
        Schema::create('invoice_templates', function (Blueprint $table) {
            $table->id();
            $table->enum('frequency', InvoiceTemplate::$frequencies);
            $table->unsignedInteger('amount')->nullable();
            $table->string('lease_no')->nullable();
            $table->foreignId('currency_id')->constrained()->onDelete('cascade');
            $table->foreignId('due_day_id')->constrained()->onDelete('cascade');
            $table->foreignId('invoice_for_attention_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('region_id')->constrained()->onDelete('cascade');
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->foreignId('landlord_id')->constrained()->onDelete('cascade');
            $table->date('last_time_paid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_templates');
    }
};
