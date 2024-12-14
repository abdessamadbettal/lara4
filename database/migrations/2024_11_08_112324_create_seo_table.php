<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo', function (Blueprint $table) {
            $table->id();

            $table->morphs('model');

            $table->json('description')->nullable();
            $table->json('title')->nullable();
            $table->string('image')->nullable();
            $table->string('author')->nullable();
            $table->string('robots')->nullable();
            $table->string('canonical_url')->nullable();
            $table->json('keywords')->nullable();
            $table->json('webmaster_tags')->nullable();
            $table->json('opengraph')->nullable();
            $table->json('twitter')->nullable();
            $table->json('json_ld')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo');
    }
};
