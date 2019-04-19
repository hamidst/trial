<?php
/**
 * Created by PhpStorm.
 * User: Hamid
 * Date: 4/19/2019
 * Time: 5:33 PM
 */

namespace App\Http\Repository;


use App\Http\Entity\Entityleague;
use App\Http\Entity\EntityMatch;
use App\Http\Entity\EntityTeam;
use App\Http\Hydrate\HydrateMatch;
use App\Http\Hydrate\HydrateTeam;
use App\Match;
use App\Team;

/**
 * Class RepositoryMatch
 * @package App\Http\Repository
 */
class RepositoryMatch
{
    /**
     * @var Match
     */
    private $modelMatch;
    /**
     * @var HydrateMatch
     */
    private $hydrateMatch;
    /**
     * @var Team
     */
    private $modelTeam;
    /**
     * @var HydrateTeam
     */
    private $hydrateTeam;

    /**
     * RepositoryMatch constructor.
     * @param $modelMatch
     * @param $hydrateMatch
     */
    public function __construct(Match $modelMatch, HydrateMatch $hydrateMatch, Team $modelTeam, HydrateTeam $hydrateTeam)
    {
        $this->modelMatch = $modelMatch;
        $this->hydrateMatch = $hydrateMatch;
        $this->modelTeam = $modelTeam;
        $this->hydrateTeam = $hydrateTeam;
    }

    /**
     * @param $week
     * @return array
     */
    public function getWeekMatches($week) : array
    {
        $matches = $this->modelMatch->newQuery()->where('week','<=',$week)->get();
        $result = [];

        if($matches)
        {
            foreach ($matches as $match)
            {
                $result[] = $this->hydrateMatch->modelToEntity($match);
            }
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getAllMatches() : array
    {
        $matches = $this->modelMatch->newQuery()->get();
        $result = [];

        if($matches)
        {
            foreach ($matches as $match)
            {
                $result[] = $this->hydrateMatch->modelToEntity($match);
            }
        }

        return $result;
    }

    /**
     * @param EntityMatch $match
     * @return EntityMatch
     */
    public function setMatchResult(EntityMatch $match) : EntityMatch
    {
        $home = $this->hydrateTeam->modelToEntity($this->modelTeam->find($match->getHome()));
        $away = $this->hydrateTeam->modelToEntity($this->modelTeam->find($match->getAway()));

        //Added 10 strength scores because of being at home
        $home->setStrength($home->getStrength() + 10);

        /*Getting difference between home and away.
        I will guess goals based on strength difference*/
        $strength_diff = abs($home->getStrength() - $away->getStrength());

        if($strength_diff > 0)
        {
            $away_goals = rand(0,3);
            $home_goals = floor($strength_diff / 4) + $away_goals;
        }
        else
        {
            $home_goals = rand(0,3);
            $away_goals = floor($strength_diff / 4) + $home_goals;
        }

        $match->setHomeGoals($home_goals);
        $match->setAwayGoals($away_goals);

        $match->setStatus('1');

        $this->modelMatch->newQuery()->where('id',$match->getId())->update($this->hydrateMatch->fromEntity($match)->toArray());

        return $match;
    }

}
