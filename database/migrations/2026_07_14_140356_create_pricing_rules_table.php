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
        Schema::create('pricing_rules', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Morph Relation
            |--------------------------------------------------------------------------
            */

            $table->morphs('ruleable');

            /*
            |--------------------------------------------------------------------------
            | Master
            |--------------------------------------------------------------------------
            */

            $table->foreignId('pricing_formula_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('price_type_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Configuration
            |--------------------------------------------------------------------------
            */

            $table->string(
                'name',
                150
            );
            
            $table->unsignedInteger('priority')
                ->default(1);

            $table->boolean('status')
                ->default(true);

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */

            $table->index([
                'ruleable_type',
                'ruleable_id',
                'price_type_id'
            ], 'idx_pricing_rule_lookup');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_rules');
    }
};