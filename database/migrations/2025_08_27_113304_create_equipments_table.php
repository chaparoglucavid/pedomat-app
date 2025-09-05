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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->string('equipment_number')->unique();
            $table->string('equipment_name')->unique();
            $table->integer('general_capacity')->default(0);
            $table->integer('battery_level')->default(100);
            $table->text('current_address');
            $table->enum('equipment_status', ['active', 'deactive', 'under_repair'])->default('active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipments');
    }
};
