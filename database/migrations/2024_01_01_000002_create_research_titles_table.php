<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('research_titles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author_name');
            $table->string('email');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research_titles');
    }
};
