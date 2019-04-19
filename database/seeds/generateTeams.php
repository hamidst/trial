<?php

use Illuminate\Database\Seeder;

class generateTeams extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('teams')->insert(
            [
                [
                    'name' => 'Arsenal',
                    'strength'  => 81
                ],
                [
                    'name' => 'Liverpol',
                    'strength'  => 81
                ],
                [
                    'Chelsea' => 'Arsenal',
                    'strength'  => 80
                ],
                [
                    'name' => 'Totenham',
                    'strength'  => 70
                ]
            ]
        );
    }
}
