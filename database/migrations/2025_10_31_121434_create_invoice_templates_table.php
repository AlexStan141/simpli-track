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
            $table->string('currency')->nullable();
            $table->string('lease_no')->nullable();
            $table->foreignIdFor(DueDay::class);
            $table->foreignIdFor(InvoiceForAttention::class);
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(Status::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Region::class);
            $table->foreignIdFor(Country::class);
            $table->foreignIdFor(City::class);
            $table->foreignIdFor(Landlord::class)->nullable();
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
