<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Post;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = DB::connection('data_dummy')->table('pages')->get();

        foreach ($posts as $post) {
            try {
                $row = Page::insert([
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'content' => $post->content,
                    'image' => $post->image,
                    'counter' => $post->counter,
                    'status' => $post->status,
                    'category_id' => 1,
                    'created_by' => $post->created_by,
                    'updated_by' => $post->updated_by,
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
