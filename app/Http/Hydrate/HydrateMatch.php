<?php
/**
 * Created by PhpStorm.
 * User: Hamid
 * Date: 4/19/2019
 * Time: 1:03 PM
 */

namespace App\Http\Hydrate;


use App\Http\Entity\EntityMatch;
use App\Match;

/**
 * Class HydrateMatch
 * @package App\Http\Hydrate
 */
class HydrateMatch
{

    /**
     * @var
     */
    private $matchEntity;

    /**
     * @param array $arrayMatch
     * @return HydrateMatch
     */
    function fromArray(array $arrayMatch) : HydrateMatch
    {
        $this->matchEntity = $this->arrayToEntity($arrayMatch);

        return $this;
    }

    /**
     * @return array
     */
    function toArray() : array
    {
        return $this->entityToArray($this->matchEntity);
    }

    /**
     * @param EntityMatch $entityMatch
     * @return HydrateMatch
     */
    function fromEntity(EntityMatch $entityMatch) : HydrateMatch
    {
        $this->matchEntity = $entityMatch;

        return $this;
    }


    /**
     * @return EntityMatch
     */
    function toEntity() : EntityMatch
    {
        return $this->matchEntity;
    }

    /**
     * @param EntityMatch $entityMatch
     * @return array
     */
    private function entityToArray(EntityMatch $entityMatch) : array
    {

        $arr = [
            'league_id' => $entityMatch->getLeagueId(),
            'home' => $entityMatch->getHome(),
            'away' => $entityMatch->getAway(),
            'home_goals' => $entityMatch->getHomeGoals(),
            'away_goals' => $entityMatch->getAwayGoals(),
            'week' => $entityMatch->getWeek(),
            'status' => $entityMatch->getStatus(),
        ];

        if($entityMatch->getHomeName())
            $arr['home_name'] = $entityMatch->getHomeName();

        if($entityMatch->getAwayName())
            $arr['away_name'] = $entityMatch->getAwayName();

        if (!empty($entityMatch->getId())) {
            $arr['id'] = $entityMatch->getId();
        }

        return $arr;
    }

    /**
     * @param array $arrayMatch
     * @return EntityMatch
     */
    private function arrayToEntity(array $arrayMatch) : EntityMatch
    {
        $entityMatch = new EntityMatch();

        if (array_key_exists('id', $arrayMatch)) {
            $entityMatch->setId($arrayMatch['id']);
        }

        if (array_key_exists('league_id', $arrayMatch)) {
            $entityMatch->setLeagueId($arrayMatch['league_id']);
        }

        if (array_key_exists('home', $arrayMatch)) {
            $entityMatch->setHome($arrayMatch['home']);
        }

        if (array_key_exists('away', $arrayMatch)) {
            $entityMatch->setAway($arrayMatch['away']);
        }

        if (array_key_exists('away_name', $arrayMatch)) {
            $entityMatch->setAwayName($arrayMatch['away_name']);
        }

        if (array_key_exists('home_name', $arrayMatch)) {
            $entityMatch->setHomeName($arrayMatch['home_name']);
        }

        if (array_key_exists('home_goals', $arrayMatch)) {
            $entityMatch->setHomeGoals($arrayMatch['home_goals']);
        }

        if (array_key_exists('away', $arrayMatch)) {
            $entityMatch->setAway($arrayMatch['away']);
        }

        if (array_key_exists('away_goals', $arrayMatch)) {
            $entityMatch->setAwayGoals($arrayMatch['away_goals']);
        }

        if (array_key_exists('week', $arrayMatch)) {
            $entityMatch->setWeek($arrayMatch['week']);
        }

        if (array_key_exists('status', $arrayMatch)) {
            $entityMatch->setStatus($arrayMatch['status']);
        }

        return $entityMatch;
    }

    /**
     * @param Match $modelMatch
     * @return EntityMatch
     */
    function modelToEntity(Match $modelMatch) : EntityMatch
    {
        $matchArray = $modelMatch->toArray();

        $this->matchEntity = $this->arrayToEntity($matchArray);
        return $this->matchEntity;
    }

}