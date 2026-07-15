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
        Schema::create('pricing_tiers', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relation
            |--------------------------------------------------------------------------
            */

            $table->foreignId('pricing_rule_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('pricing_rule_detail_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Quantity Tier
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger(
                'qty_min'
            );

            $table->unsignedInteger(
                'qty_max'
            );

            /*
            |--------------------------------------------------------------------------
            | Price
            |--------------------------------------------------------------------------
            */

            $table->decimal(
                'price',
                15,
                2
            );

            $table->unsignedInteger(
                'sort_order'
            )->default(1);

            /*
            |--------------------------------------------------------------------------
            | Effective Date
            |--------------------------------------------------------------------------
            */

            $table->date(
                'effective_from'
            )->nullable();

            $table->date(
                'effective_until'
            )->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean(
                'status'
            )->default(true);

            $table->timestamps();

            $table->unique(
            [
            'pricing_rule_detail_id',
            'qty_min',
            'qty_max'
            ]);

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */

            $table->index(
                [
                    'pricing_rule_id',
                    'qty_min',
                    'qty_max'
                ],
                'idx_pricing_rule_qty'
            );

            $table->index(
                [
                    'pricing_rule_detail_id',
                    'qty_min',
                    'qty_max'
                ],
                'idx_pricing_detail_qty'
            );

            $table->index(
                [
                    'effective_from',
                    'effective_until'
                ],
                'idx_pricing_effective'
            );

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'pricing_tiers'
        );
    }
};