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
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->morphs('phoneable'); // user, company, etc.
            $table->string('country_code', 5)->nullable(); // +1, +44, etc.
            $table->string('number')->unique(); // 1234567890
            $table->string('type'); // mobile, home, work, etc.
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            $table->index(['phoneable_id', 'phoneable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phones');
    }
};
