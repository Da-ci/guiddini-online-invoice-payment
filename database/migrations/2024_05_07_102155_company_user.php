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
        Schema::create('company_user', function (Blueprint $table){
            $table->uuid('company_id');
            $table->foreign('company_id')->references('id')->on('companies');

            $table->boolean('is_main_contact')->default(false);
            
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->primary(['company_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_user');
    }
};
