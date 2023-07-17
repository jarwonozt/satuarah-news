<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Page;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = DB::connection('data_dummy')->table('files')->get();

        foreach ($rows as $row) {
            try {
                $save = File::insert([
                    'title' => $row->title,
                    'slug' => $row->slug,
                    'name' => $row->name,
                    'type' => $row->type,
                    'size' => $row->size,
                    'description' => $row->description,
                    'status' => $row->status,
                    'category_id' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => $row->created_at,
                    'updated_at' => $row->updated_at,
                ]);

                echo $row->title.' ✅'.PHP_EOL;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}
