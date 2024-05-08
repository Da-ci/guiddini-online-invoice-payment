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
            $table->uuid('id');
            $table->string('name');
            $table->decimal('regular_price', 14, 2 );
            $table->boolean('sale_flag')->default(false);
            $table->decimal('sale_price', 14, 2)->nullable();
            $table->date('sale_starts')->nullable();
            $table->date('sale_ends')->nullable();
            $table->unsignedBigInteger('total_sales')->default(0);
            $table->json('tags')->nullable();
            $table->string('description')->nullable();
            $table->string('image_path')->nullable();
            $table->uuid('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
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
