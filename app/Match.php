<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table = 'matches';

    protected $fillable = [
        'league_id',
        'home',
        'away',
        'home_goals',
        'away_goals',
        'status',
        'week'
    ];

}
