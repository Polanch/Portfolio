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
        // Drop dependent tables first
        Schema::dropIfExists('comment_votes');
        Schema::dropIfExists('comments');

        // Recreate comments table with all columns
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('comment');
            $table->string('page')->default('welcome');
            $table->unsignedInteger('likes_count')->default(0);
            $table->unsignedInteger('dislikes_count')->default(0);
            $table->foreignId('parent_comment_id')->nullable()->constrained('comments')->onDelete('cascade');
            $table->timestamps();
        });

        // Recreate comment_votes table
        Schema::create('comment_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('comment_id')->constrained('comments')->onDelete('cascade');
            $table->enum('vote_type', ['like', 'dislike']);
            $table->timestamps();
            $table->unique(['user_id', 'comment_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_votes');
        Schema::dropIfExists('comments');
    }
};
