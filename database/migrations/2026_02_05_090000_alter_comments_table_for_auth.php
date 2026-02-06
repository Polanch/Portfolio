<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if the table has the old structure
        if (Schema::hasTable('comments') && Schema::hasColumn('comments', 'name')) {
            // Backup comments by prepending the name to the comment text
            $comments = DB::table('comments')->get();
            foreach ($comments as $comment) {
                DB::table('comments')
                    ->where('id', $comment->id)
                    ->update([
                        'comment' => "**{$comment->name}**: {$comment->comment}"
                    ]);
            }

            // Get or create a default user for old comments
            $user = DB::table('users')->first();
            if (!$user) {
                $userId = DB::table('users')->insertGetId([
                    'name' => 'Admin',
                    'email' => 'admin@example.com',
                    'password' => bcrypt('password'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $userId = $user->id;
            }

            // Drop the name column
            Schema::table('comments', function (Blueprint $table) {
                $table->dropColumn('name');
            });

            // Add new columns with user_id
            Schema::table('comments', function (Blueprint $table) {
                $table->foreignId('user_id')
                    ->after('id')
                    ->default(1)
                    ->constrained('users')
                    ->onDelete('cascade');
                    
                $table->integer('likes_count')
                    ->default(0)
                    ->after('page');
                    
                $table->integer('dislikes_count')
                    ->default(0)
                    ->after('likes_count');
                    
                $table->unsignedBigInteger('parent_comment_id')
                    ->after('dislikes_count')
                    ->nullable();
            });

            // Add foreign key constraint for parent_comment_id
            Schema::table('comments', function (Blueprint $table) {
                $table->foreign('parent_comment_id')
                    ->references('id')
                    ->on('comments')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration had issues, so we just skip the rollback
        // The database is already in the desired state
    }
};

