<?php

namespace Database\Seeders;

use App\Models\Point;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $points = DB::connection('data_dummy')->table('points')->get();

        foreach ($points as $point) {
            try {
                $row = Point::insert([
                    'modul' => $point->modul,
                    'user_type' => $point->user_type,
                    'user_id' => 1,
                    'category_id' => 1,
                    'post_id' => $point->post_id,
                    'point' => $point->point,
                    'created_at' => $point->created_at,
                    'updated_at' => $point->updated_at,
                ]);

                echo $point->modul.' ✅'.PHP_EOL;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}
