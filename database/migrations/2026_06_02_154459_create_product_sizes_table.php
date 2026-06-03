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
        Schema::create('product_sizes', function (Blueprint $table) {
        $table->id();

        $table->foreignId('product_id')
        ->constrained()
        ->cascadeOnDelete();

        $table->string('name');

        $table->decimal('width', 10, 2)->nullable();
        $table->decimal('height', 10, 2)->nullable();

        $table->decimal('price', 15, 2);

        $table->date('effective_from');
        $table->date('effective_until')->nullable();

        $table->boolean('status')->default(true);

        $table->unique([
            'product_id',
            'name'
        ]);
        
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sizes');
    }
};
