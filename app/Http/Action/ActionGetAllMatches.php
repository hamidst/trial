<?php
/**
 * Created by PhpStorm.
 * User: Hamid
 * Date: 4/19/2019
 * Time: 5:07 PM
 */

namespace App\Http\Action;


use App\Http\Hydrate\HydrateMatch;
use App\Http\Repository\RepositoryMatch;
use App\Http\Repository\RepositoryTeam;

/**
 * Class ActionGetWeekMatches
 * @package App\Http\Action
 */
class ActionGetAllMatches
{

    /**
     * @var RepositoryMatch
     */
    private $repositoryMatch;
    /**
     * @var HydrateMatch
     */
    private $hydrateMatch;

    private $repositoryTeam;

    /**
     * ActionGetWeekMatches constructor.
     * @param $repositoryMatch
     * @param $hydrateMatch
     */
    public function __construct(RepositoryMatch $repositoryMatch, HydrateMatch $hydrateMatch, RepositoryTeam $repositoryTeam)
    {
        $this->repositoryMatch = $repositoryMatch;
        $this->hydrateMatch = $hydrateMatch;
        $this->repositoryTeam = $repositoryTeam;
    }


    /**
     * @param $week_num
     * @return array
     */
    public function __invoke()
    {
        $all_matches = $this->repositoryMatch->getAllMatches();

        if($all_matches)
        {
            foreach ($all_matches as $index => $week_match)
            {
                $all_matches[$index]->setHomeName($this->repositoryTeam->get($week_match->getHome())->getName());
                $all_matches[$index]->setAwayName($this->repositoryTeam->get($week_match->getAway())->getName());
            }
        }
        else
        {
            return null;
        }

        return $all_matches;

    }

}
