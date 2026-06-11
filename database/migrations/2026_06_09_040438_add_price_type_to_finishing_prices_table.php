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
        Schema::table('finishing_prices', function (Blueprint $table) {
            $table->enum(
                'price_type',
                [
                    'normal',
                    'sponsor'
                ]
            )
            ->default('normal')
            ->after('finishing_variant_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('finishing_prices', function (Blueprint $table) {
            $table->dropColumn(
                'price_type'
            );
        });
    }
};
