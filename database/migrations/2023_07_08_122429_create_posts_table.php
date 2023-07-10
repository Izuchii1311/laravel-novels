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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            # foreign id untuk menghubungkan dengan primary key dari table lain
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('writer');
            $table->string('author');
            $table->string('publisher');
            $table->text('excerpt');
            $table->text('body');
            $table->date('publication_year');
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
