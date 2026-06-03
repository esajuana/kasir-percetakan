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
        Schema::create('product_prices', function (Blueprint $table) {

            $table->id();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('product_variant_id')
                ->nullable()
                ->constrained('product_variants')
                ->nullOnDelete();

            $table->integer('qty_min');

            $table->integer('qty_max');

            $table->decimal('price',15,2);

            $table->date('effective_from');

            $table->date('effective_until')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->index(
                ['product_id', 'product_variant_id', 'qty_min', 'qty_max'],
                'idx_product_price_lookup'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_prices');
    }
};
