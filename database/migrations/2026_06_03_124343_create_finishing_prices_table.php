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
        Schema::create('finishing_prices', function (Blueprint $table) {

            $table->id();

            $table->foreignId('finishing_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('finishing_variant_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->integer('qty_min');

            $table->integer('qty_max');

            $table->decimal('price',15,2);

            $table->date('effective_from');

            $table->date('effective_until')->nullable();

            $table->boolean('status')->default(true);

            $table->index([
                'finishing_id',
                'finishing_variant_id',
                'qty_min',
                'qty_max'
            ], 'idx_finishing_price_lookup');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finishing_prices');
    }
};
