<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('sales', function (Blueprint $table) {

        $table->decimal('amount_owed', 10, 2)->nullable();
        $table->string('status')->nullable();
        $table->timestamp('last_payment_at')->nullable();

    });
}

public function down(): void
{
    Schema::table('sales', function (Blueprint $table) {
        $table->dropColumn([
            'amount_owed',
            'status',
            'last_payment_at'
        ]);
    });
}
    
};
