<?php

namespace Database\Seeders;

use App\Models\PointSetting;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PointSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $points = DB::connection('data_dummy')->table('point_settings')->get();

        foreach ($points as $point) {
            try {
                $row = PointSetting::insert([
                    'modul' => $point->modul,
                    'user_type' => $point->user_type,
                    'category_id' => $point->category_id,
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
