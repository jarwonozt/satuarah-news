<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\VideoCategory;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = DB::connection('data_dummy')->table('video_categories')->get();

        foreach ($posts as $post) {
            try {
                $row = VideoCategory::insert([
                    'name' => $post->name,
                    'slug' => $post->slug,
                    'description' => $post->description,
                    'order' => $post->order,
                    'status' => $post->status,
                    'parent_id' => $post->parent_id,
                    'created_by' => $post->created_by,
                    'updated_by' => $post->updated_by,
                    'created_at' => $post->created_at,
                    'updated_at' => $post->updated_at,
                ]);

                echo $post->name.' ✅'.PHP_EOL;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}
