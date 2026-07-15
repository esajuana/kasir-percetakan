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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Nomor Transaksi
            |--------------------------------------------------------------------------
            */

            $table->string('invoice_number')
                ->unique();

            $table->string('queue_number')
                ->index();

            /*
            |--------------------------------------------------------------------------
            | Informasi Transaksi
            |--------------------------------------------------------------------------
            */

            $table->dateTime('transaction_date')
                ->index();

            $table->foreignId('service_level_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->dateTime('estimated_finish')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Data Customer
            |--------------------------------------------------------------------------
            */

            $table->string('customer_name');

            $table->string('customer_phone')
                ->nullable();

            $table->string('institution')
                ->nullable();

            $table->text('customer_address')
                ->nullable();

            $table->enum('customer_type', [
                'normal',
                'sponsor'
            ])
            ->default('normal')
            ->index();

            $table->text('customer_note')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Total Harga
            |--------------------------------------------------------------------------
            */

            $table->decimal(
                'subtotal_product',
                15,
                2
            )->default(0);

            $table->decimal(
                'subtotal_finishing',
                15,
                2
            )->default(0);

            $table->decimal(
                'discount',
                15,
                2
            )->default(0);

            $table->decimal(
                'additional_cost',
                15,
                2
            )->default(0);

            $table->decimal(
                'grand_total',
                15,
                2
            )->default(0);

            $table->json('calculation_snapshot')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Pembayaran
            |--------------------------------------------------------------------------
            */

            $table->decimal(
                'paid_amount',
                15,
                2
            )->default(0);

            $table->decimal(
                'remaining_amount',
                15,
                2
            )->default(0);

            $table->enum('payment_status', [
                'unpaid',
                'dp',
                'paid'
            ])
            ->default('unpaid')
            ->index();

            /*
            |--------------------------------------------------------------------------
            | User
            |--------------------------------------------------------------------------
            */

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */

            $table->index([
                'transaction_date',
                'payment_status',
                'production_status'
            ], 'idx_transaction_status');

            $table->index([
                'customer_name',
                'customer_phone'
            ], 'idx_transaction_customer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
