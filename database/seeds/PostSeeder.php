<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
        	['user_id'=>1, 'title'=>'Title one', 'content'=>'Post one content'],
        	['user_id'=>1, 'title'=>'Title two', 'content'=>'Post two content'],
        	['user_id'=>1, 'title'=>'Title three', 'content'=>'Post three content'],
        ]);
    }
}
