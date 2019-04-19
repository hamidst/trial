<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ModelTeam
 * @package App
 */
class Team extends Model
{
    /**
     * @var string
     */
    protected $table = 'teams';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'strength'
    ];

    public function leagues()
    {
        $this->belongsToMany(League::class);
    }
}
