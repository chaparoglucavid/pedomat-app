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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('equipment_id')->constrained('equipments')->onDelete('cascade')->onUpdate('cascade');
            $table->string('order_number')->nullable();
            $table->integer('order_qty_sum')->default(0);
            $table->decimal('order_amount_sum', 10,2)->default(0.00);
            $table->string('invoice')->nullable();
            $table->enum('payment_method', ['balance', 'card'])->default('balance');
            $table->enum('payment_status', ['pending', 'processing', 'completed'])->default('pending');
            $table->text('barcode')->nullable();
            $table->enum('barcode_status', ['not_used', 'used'])->default('not_used');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
