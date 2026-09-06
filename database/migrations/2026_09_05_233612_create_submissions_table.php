<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('entity_name');
            $table->string('official_url');
            $table->text('description')->nullable();
            $table->string('governorate');
            $table->string('category_name')->nullable();
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
