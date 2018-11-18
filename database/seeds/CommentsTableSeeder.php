<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Post;
use App\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('comments')->truncate();

        $faker = Factory::create();
        $posts = Post::all();
        foreach ($posts as $p){
            $r = rand(0, 3);
            for ($i = 0; $i < $r; $i++){
//                $comments[] = [
//                    'user_id' => rand(1, 3),
//                    'post_id' => $p->id,
//                    'body' => $faker->paragraphs(rand(1, 3), true)
//                ];
                App\Comment::create([
                    'user_id' => rand(1, 3),
                    'post_id' => $p->id,
                    'body' => $faker->paragraphs(rand(1, 3), true)
                ]);
            }
        }
//        Comment::truncate();
//        Comment::insert($comments);

    }
}
