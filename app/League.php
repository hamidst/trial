<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ModelLeague
 * @package App
 */
class League extends Model
{
    /**
     * @var string
     */
    protected $table = 'leagues';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'year   '
    ];

    /**
     *
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

}
