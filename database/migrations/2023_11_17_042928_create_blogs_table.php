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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('sub_category_id')->constrained()->nullable()->nullOnDelete();
            $table->foreignId('sub_category_id')->constrained()->nullable();
            $table->string('title');
            $table->string('image');
            $table->text('body');
            $table->text('download_link')->nullable();
            $table->boolean('direct_download')->default(0);
            $table->integer('views')->default(0);
            $table->text('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
