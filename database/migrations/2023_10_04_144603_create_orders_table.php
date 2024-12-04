<?php

use App\Enums\OrderStatus;
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
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('address_id');
            $table->double('total_price');
            $table->double('tax');
            $table->integer('status')->comment('App\Enums\OrderStatus')->default(OrderStatus::OrderPlaced->value);
            $table->enum('type', ['Personal', 'Gift']);
            $table->string('gift_owner_name')->nullable();
            $table->string('gift_owner_phone')->nullable();
            $table->string('gift_text')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('address_id')->references('id')->on('addresses');
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
