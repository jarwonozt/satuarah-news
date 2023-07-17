<?php

namespace Database\Seeders;

use App\Models\Video;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = DB::connection('data_dummy')->table('videos')->get();

        foreach ($posts as $post) {
            try {
                $row = Video::insert([
                    'code' => $post->code,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'content' => $post->content,
                    'tags' => $post->tags,
                    'counter' => $post->counter,
                    'youtube_id' => $post->youtube_id,
                    'status' => $post->status,
                    'category_id' => 1,
                    'created_by' => $post->created_by,
                    'updated_by' => $post->updated_by,
                    'published_at' => $post->published_at,
                    'created_at' => $post->created_at,
                    'updated_at' => $post->updated_at,
                ]);

                echo $post->title.' ✅'.PHP_EOL;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}
