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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'payment_user_id'
            )->cascadeOnDelete();
            $table->foreignId('donasi_id')->nullable()->constrained(
                table: 'donasis',
                indexName: 'payment_donasi_id'
            );
            $table->foreignId('urundana_id')->nullable()->constrained(
                table: 'urundanas',
                indexName: 'payment_urundana_id'
            )->nullOnDelete();
            $table->string('order_id')->nullable()->unique();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('pesan')->nullable();
            $table->decimal('amount', 20, 2)->default(0);
            $table->enum('status', [
                'Pending',
                'Success',
                'Error', 
            ])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
