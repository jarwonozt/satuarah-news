<?php

namespace Database\Seeders;

use App\Models\Post;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for ($i=0; $i < 90; $i++) {
            $row[$i] = Post::where('id', '>', 70)->update([
                    // 'code' => $faker->regexify('[A-Z]{5}[0-4]{3}'),
                    // 'prefix' => $post->prefix,
                    // 'title' => Str::title($faker->words(6, true)),
                    // 'slug' => Str::slug($faker->words(4, true)),
                    // 'preview' => $faker->words(30, true),
                    // 'content' => $faker->words(300, true),
                    // 'image' => null,
                    // 'caption' => $faker->words(4, true),
                    'tags' => implode(',', $faker->words(3)),
                    // 'counter' => $faker->randomNumber(3, false),
                    // 'type' => $faker->numberBetween(1, 3),
                    // 'status' => 1,
                    // 'category_id' => 1,
                    // 'created_by' => 1,
                    // 'updated_by' => null,
                    // 'published_at' => Carbon::now(),
                    // 'created_at' => Carbon::now(),
                    // 'updated_at' => Carbon::now(),
                    // 'source' => $post->source,
                ]);
        }
        // $posts = DB::connection('data_dummy')->table('posts')->get();
        // foreach ($posts as $post) {
        //     try {
        //         $row = Post::insert([
        //             'code' => $post->code,
        //             'prefix' => $post->prefix,
        //             'title' => $post->title,
        //             'slug' => $post->slug,
        //             'preview' => $post->preview,
        //             'content' => $post->content,
        //             'image' => $post->image,
        //             'caption' => $post->caption,
        //             'tags' => $post->tags,
        //             'counter' => $post->counter,
        //             'type' => $post->type,
        //             'status' => $post->status,
        //             'category_id' => 1,
        //             'created_by' => $post->created_by,
        //             'updated_by' => $post->updated_by,
        //             'published_at' => $post->published_at,
        //             'created_at' => $post->created_at,
        //             'updated_at' => $post->updated_at,
        //             'source' => $post->source,
        //         ]);

        //         echo $post->title.' ✅'.PHP_EOL;
        //     } catch (Exception $e) {
        //         echo $e->getMessage();
        //     }
        // }
    }
}
