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
        Schema::table('permissions', function (Blueprint $table) {
            $table->after('guard_name', function (Blueprint $table) {
                $table->string('description');
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->tinyInteger('display_order')->default(0);
            });

            $table->foreign('parent_id')
                ->references('id')
                ->on('permissions')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            //
        });
    }
};
