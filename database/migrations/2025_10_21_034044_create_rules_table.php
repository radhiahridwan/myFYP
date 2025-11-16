<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Rule title
            $table->text('description')->nullable(); // Rule description
            $table->foreignId('admin_id')->nullable()->constrained()->onDelete('set null'); // Optional: if rules are created by admins
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};


