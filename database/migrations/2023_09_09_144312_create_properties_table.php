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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->date('date_online');
            $table->date('date_offline');
            $table->foreignId('country_id')->constrained();
            $table->foreignId('contact_id')->constrained();
            $table->foreignId('currency_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->decimal('price', 10, 2);
            $table->decimal('sale', 10, 2);
            $table->string('type');
            $table->integer('bedrooms');
            $table->integer('drawing_rooms');
            $table->integer('bathrooms');
            $table->boolean('pool');
            $table->text('overview');
            $table->text('why_buy');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->foreignId('deleted_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
