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
        Schema::create('transaction_logs', function (Blueprint $table) {

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
            | Aktivitas
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('log_order')
                ->default(1);

            $table->enum('log_type', [

                'transaction',

                'payment',

                'item',

                'system',

            ]);

            $table->string('title');

            $table->text('description')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->string('old_value')
                ->nullable();

            $table->string('new_value')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | User
            |--------------------------------------------------------------------------
            */

            $table->foreignId('performed_by')
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
                    'log_order'
                ],
                'idx_transaction_log_order'
            );

            $table->index(
                [
                    'transaction_id',
                    'log_type'
                ],
                'idx_transaction_log_type'
            );

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_logs');
    }
};