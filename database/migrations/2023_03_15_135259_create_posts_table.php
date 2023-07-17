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
            $table->string('code', 10);
            $table->string('prefix')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->text('preview')->nullable();
            $table->longText('content');
            $table->string('image')->nullable();
            $table->string('caption')->nullable();
            $table->string('tags')->nullable();
            $table->integer('counter')->default(0);
            $table->tinyInteger('type')->default(1);
            $table->tinyInteger('status')->nullable();
            $table->integer('category_id');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->string('source')->nullable();
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
