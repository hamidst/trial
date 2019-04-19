<?php

use Illuminate\Database\Seeder;

class Import_matches extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('matches')->insert(
        [
            [
                'league_id' => 1,
                'home'  => 1,
                'away'  => 2,
                'week'  => 1
            ],[
                'league_id' => 1,
                'home'  => 3,
                'away'  => 4,
                'week'  => 1
            ],[
                'league_id' => 1,
                'home'  => 1,
                'away'  => 3,
                'week'  => 2
            ],[
                'league_id' => 1,
                'home'  => 2,
                'away'  => 4,
                'week'  => 2
            ],[
                'league_id' => 1,
                'home'  => 1,
                'away'  => 4,
                'week'  => 3
            ],[
                'league_id' => 1,
                'home'  => 2,
                'away'  => 3,
                'week'  => 3
            ],[
                'league_id' => 1,
                'home'  => 2,
                'away'  => 1,
                'week'  => 4
            ],[
                'league_id' => 1,
                'home'  => 4,
                'away'  => 3,
                'week'  => 4
            ],[
                'league_id' => 1,
                'home'  => 3,
                'away'  => 1,
                'week'  => 5
            ],[
                'league_id' => 1,
                'home'  => 4,
                'away'  => 2,
                'week'  => 5
            ],[
                'league_id' => 1,
                'home'  => 4,
                'away'  => 1,
                'week'  => 6
            ],[
                'league_id' => 1,
                'home'  => 3,
                'away'  => 2,
                'week'  => 6
            ]
        ]);
    }
}
