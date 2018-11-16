<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\Post;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset the table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('tags')->truncate();

        // create not in a conventional way so that easy to relate
        $a = new Tag();
        $a->name = 'PHP';
        $a->slug = 'php';
        $a->save();
        $b = new Tag();
        $b->name = 'Laravel';
        $b->slug = 'laravel';
        $b->save();
        $c = new Tag();
        $c->name = 'Public Society';
        $c->slug = 'public-society';
        $c->save();
        $d = new Tag();
        $d->name = 'Animal Kingdom';
        $d->slug = 'animal-kingdom';
        $d->save();
        $e = new Tag();
        $e->name = 'Vue js';
        $e->slug = 'vue-js';
        $e->save();

        $tag_id = [$a->id, $b->id, $c->id, $d->id, $e->id];


        foreach (Post::all() as $p){
            shuffle($tag_id);
            $p->tags()->detach();

//            for ($i = 0; $i < rand(0, count($tag_id)-1); $i++ ){
            $r = rand(0, 2);
            for ($i = 0; $i <= $r; $i++ ){
                $p->tags()->detach($tag_id[$i]);
                $p->tags()->attach($tag_id[$i]);
            }
        }


    }
}
