<?php

namespace Database\Seeders;

use App\Models\Service;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = DB::connection('data_dummy')->table('services')->get();

        foreach ($posts as $post) {
            try {
                $row = Service::insert([
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'description' => $post->description,
                    'image' => $post->image,
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
