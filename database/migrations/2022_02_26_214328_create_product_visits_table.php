<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVisitsTable extends Migration
{
    public function up(): void
    {
        Schema::create('product_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->string('ip', 120);
            $table->string('browser', 120);
            $table->string('os', 120);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_visits');
    }
}
