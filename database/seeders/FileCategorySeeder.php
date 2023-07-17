<?php

namespace Database\Seeders;

use App\Models\FileCategory;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = DB::connection('data_dummy')->table('file_categories')->get();

        foreach ($rows as $row) {
            try {
                $save = FileCategory::insert([
                    'name' => $row->name,
                    'slug' => $row->slug,
                    'description' => $row->description,
                    'status' => $row->status,
                    'parent_id' => $row->parent_id,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => $row->created_at,
                    'updated_at' => $row->updated_at,
                ]);

                echo $row->name.' ✅'.PHP_EOL;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}
