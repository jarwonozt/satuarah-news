<?php

namespace Database\Seeders;

use App\Models\PageCategory;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postCategories = DB::connection('data_dummy')->table('page_categories')->get();

        foreach ($postCategories as $post) {
            try {
                $row = PageCategory::insert([
                    'name' => $post->name,
                    'slug' => $post->slug,
                    'description' => $post->description,
                    'order' => $post->order,
                    'status' => $post->status,
                    'parent_id' => 1,
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
