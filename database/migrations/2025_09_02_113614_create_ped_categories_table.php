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
        Schema::create('ped_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->text('reason_for_use')->nullable();
            $table->decimal('unit_price', 8, 2)->default(0.50);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ped_categories');
    }
};
