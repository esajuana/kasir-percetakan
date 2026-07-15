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
        Schema::create('transaction_item_finishings', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relasi
            |--------------------------------------------------------------------------
            */

            $table->foreignId('transaction_item_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('finishing_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('finishing_variant_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Snapshot
            |--------------------------------------------------------------------------
            */

            $table->string('finishing_name_snapshot');

            $table->string('variant_name_snapshot')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Harga
            |--------------------------------------------------------------------------
            */

            $table->enum('master_price_source', [

                'normal',

                'sponsor',

                'manual',

            ]);

            $table->enum('price_type', [

                'normal',

                'sponsor',

                'manual',

            ]);

            /*
            |--------------------------------------------------------------------------
            | Quantity
            |--------------------------------------------------------------------------
            */

            $table->decimal(
                'qty',
                12,
                2
            );

            $table->string('unit_snapshot', 20)
                ->nullable();
            
            $table->decimal(
                'price_unit_snapshot',
                15,
                2
            );

            /*
            |--------------------------------------------------------------------------
            | Harga
            |--------------------------------------------------------------------------
            */

            $table->decimal(
                'master_unit_price',
                15,
                2
            )->nullable();

            $table->decimal(
                'unit_price',
                15,
                2
            );

            $table->decimal(
                'master_subtotal',
                15,
                2
            )->nullable();

            $table->decimal(
                'subtotal',
                15,
                2
            );

            /*
            |--------------------------------------------------------------------------
            | Perhitungan
            |--------------------------------------------------------------------------
            */

            $table->json(
                'calculation_breakdown'
            )->nullable();

            /*
            |--------------------------------------------------------------------------
            | Lainnya
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger(
                'sort_order'
            )->default(1);

            $table->text('note')
                ->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */

            $table->index(
                [
                    'transaction_item_id',
                    'sort_order'
                ],
                'idx_transaction_finishing_sort'
            );

            $table->index('price_type');

            $table->index('master_price_source');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'transaction_item_finishings'
        );
    }
};