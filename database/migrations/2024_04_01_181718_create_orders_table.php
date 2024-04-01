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
            $table->string('order_number')->unique();
            $table->double('total_amount');
            $table->double('discount_amount');
            $table->double('gross_amount');
            $table->double('shipping_amount');
            $table->double('net_amount');
            $table->enum('status', ['placed', 'processing', 'shipping', 'delivered'])->default('placed');
            $table->enum('payment_status', ['paid', 'notpaid'])->default('notpaid');
            $table->enum('payment_type', ['bank', 'card', 'cod', 'bkash','nagad', 'rocket'])->default('cod');
            $table->string('transaction_id');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
