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
        Schema::create('transaction_payments', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relasi
            |--------------------------------------------------------------------------
            */

            $table->foreignId('transaction_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Urutan Pembayaran
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('payment_order')
                ->default(1);

            /*
            |--------------------------------------------------------------------------
            | Informasi Pembayaran
            |--------------------------------------------------------------------------
            */

            $table->dateTime('payment_date');

            $table->enum('payment_method', [

                'cash',

                'transfer',

            ]);

            $table->enum('payment_type', [

                'dp',

                'installment',

                'full',

                'refund',

            ]);

            /*
            |--------------------------------------------------------------------------
            | Nominal
            |--------------------------------------------------------------------------
            */

            $table->decimal(
                'amount',
                15,
                2
            );

            $table->decimal(
                'balance_after',
                15,
                2
            )->default(0);

            /*
            |--------------------------------------------------------------------------
            | Catatan
            |--------------------------------------------------------------------------
            */

            $table->text('note')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | User
            |--------------------------------------------------------------------------
            */

            $table->foreignId('processed_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */

            $table->index(
                [
                    'transaction_id',
                    'payment_order'
                ],
                'idx_transaction_payment_order'
            );

            $table->index(
                [
                    'transaction_id',
                    'payment_date'
                ],
                'idx_transaction_payment_date'
            );

            $table->index(
                [
                    'payment_method',
                    'payment_type'
                ],
                'idx_payment_method_type'
            );

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_payments');
    }
};