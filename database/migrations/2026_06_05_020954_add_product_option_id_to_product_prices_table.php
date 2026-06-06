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
        Schema::table('product_prices', function (Blueprint $table) {
            $table->foreignId('product_option_id')
                ->nullable()
                ->after('product_variant_id')
                ->constrained('product_options')
                ->nullOnDelete();

            $table->index(
                [
                    'product_id',
                    'product_variant_id',
                    'product_option_id'
                ],
                'idx_product_price_option'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_prices', function (Blueprint $table) {

            $table->dropIndex('idx_product_price_option');

            $table->dropConstrainedForeignId(
                'product_option_id'
            );
        });
    }
};
