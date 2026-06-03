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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();

            $table->enum('calculation_type', [
                'area',
                'length',
                'unit',
                'size_fixed',
                'package',
                'manual'
            ]);

            $table->decimal('minimum_price',15,2)->default(0);

            $table->enum('rounding_type',[
                'none',
                'decimal_1',
                'decimal_2',
                'ceil'
            ])->default('none');

            $table->boolean('allow_finishing')->default(true);

            $table->boolean('is_package')->default(false);

            $table->boolean('manage_stock')->default(false);

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
