<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('sales', function (Blueprint $table) {
        $table->id();

        $table->string('item_name');
        $table->decimal('selling_price', 10, 2);
        $table->decimal('cost_price', 10, 2);
        $table->integer('quantity')->default(1);

        $table->string('payment_method');

        $table->string('customer_name')->nullable();
        $table->decimal('remaining_balance', 10, 2)->nullable();

        $table->timestamps();
    });
}

};
