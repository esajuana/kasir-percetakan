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
        Schema::create('transaction_items', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relasi
            |--------------------------------------------------------------------------
            */

            $table->foreignId('transaction_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('product_variant_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('product_option_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('parent_item_id')
                ->nullable()
                ->constrained('transaction_items')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Jenis Item
            |--------------------------------------------------------------------------
            */

            $table->enum('item_type', [
                'master',
                'manual',
            ])->default('master');

            $table->string('manual_product_name')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Snapshot Master
            |--------------------------------------------------------------------------
            */

            $table->string('product_name_snapshot');

            $table->string('variant_name_snapshot')
                ->nullable();

            $table->string('option_name_snapshot')
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
            | Perhitungan
            |--------------------------------------------------------------------------
            */

            $table->enum('calculation_type', [
                'unit',
                'area',
                'length',
                'perimeter',
                'manual',
                'package',
            ]);

            $table->decimal('width', 10, 2)
                ->nullable();

            $table->decimal('height', 10, 2)
                ->nullable();

            $table->decimal('length', 10, 2)
                ->nullable();

            $table->decimal('perimeter', 10, 2)
                ->nullable();

            $table->decimal('area', 10, 4)
                ->nullable();

            $table->decimal('qty', 12, 2);

            $table->string('unit_snapshot', 20)
                ->nullable();
            
            $table->decimal('price_unit_snapshot', 15, 2);

            /*
            |--------------------------------------------------------------------------
            | Harga
            |--------------------------------------------------------------------------
            */

            $table->decimal('master_unit_price', 15, 2)
                ->nullable();

            $table->decimal('unit_price', 15, 2);

            $table->decimal('master_subtotal', 15, 2)
                ->nullable();

            $table->decimal('subtotal', 15, 2);

            /*
            |--------------------------------------------------------------------------
            | Lainnya
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('sort_order')
                ->default(1);

            $table->text('item_note')
                ->nullable();

            $table->boolean('has_finishing')
            ->default(false)
            ->index();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */

            $table->index(
                ['transaction_id', 'sort_order'],
                'idx_transaction_item_sort'
            );

            $table->index(
                ['product_id', 'product_variant_id'],
                'idx_transaction_product'
            );

            $table->index('item_type');

            $table->index('price_type');

            $table->index('master_price_source');

            $table->index('has_finishing');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_items');
    }
};