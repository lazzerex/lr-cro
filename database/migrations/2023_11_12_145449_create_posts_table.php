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
            $table->foreignId('author_id')->constrained('users');
            $table->text('title');
            $table->text('slug')->unique();
            $table->text('excerpt');
            $table->longText('content');
            $table->string('status', 20)->default('publish')->index();
            $table->string('comment_status', 20)->default('open');
            $table->integer('comment_count')->default(0);
            $table->timestamp('published_at');
            $table->timestamps();
        });

        Schema::create('post_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_primary')->default(0);
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
