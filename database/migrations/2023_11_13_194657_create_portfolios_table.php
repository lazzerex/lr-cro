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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author')->constrained('users');
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
