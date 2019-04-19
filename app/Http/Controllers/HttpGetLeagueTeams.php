<?php

namespace App\Http\Controllers;

use App\League;
use Illuminate\Http\Request;

/**
 * Class HttpGetLeagueTeams
 * @package App\Http\Controllers
 */
class HttpGetLeagueTeams extends Controller
{

    /**
     * @var
     */
    private $modelLeague;

    /**
     * HttpGetLeagueTeams constructor.
     * @param $modelLeague
     */
    public function __construct(League $modelLeague)
    {
        $this->modelLeague = $modelLeague;
    }

    /**
     *
     */
    public function __invoke($id)
    {

        $teams = $this->modelLeague->newQuery()->find($id);

        return $teams->teams;
    }

}
