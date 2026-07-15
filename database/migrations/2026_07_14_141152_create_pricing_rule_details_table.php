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
        Schema::create('pricing_rule_details', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relation
            |--------------------------------------------------------------------------
            */

            $table->foreignId('pricing_rule_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Parameter
            |--------------------------------------------------------------------------
            */

            $table->string(
                'parameter',
                100
            );

            $table->text(
                'value'
            );

            /*
            |--------------------------------------------------------------------------
            | Value Type
            |--------------------------------------------------------------------------
            */

            $table->string(
                'value_type',
                20
            )->default('string');

            /*
            |--------------------------------------------------------------------------
            | Configuration
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger(
                'sort_order'
            )->default(1);

            $table->boolean(
                'status'
            )->default(true);

            $table->timestamps();

            $table->unique(
                [
                    'pricing_rule_id',
                    'parameter',
                    'value'
                ],
                'uk_pricing_rule_parameter_value'
            );

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */

            $table->index(
                [
                    'pricing_rule_id',
                    'parameter'
                ],
                'idx_pricing_rule_parameter'
            );

            $table->index(
                [
                    'parameter',
                    'value_type'
                ],
                'idx_parameter_type'
            );

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'pricing_rule_details'
        );
    }
};