<?php
/**
 * Created by PhpStorm.
 * User: Hamid
 * Date: 4/19/2019
 * Time: 12:58 PM
 */

namespace App\Http\Entity;


class EntityMatch
{
    private $id;
    private $league_id;
    private $home;
    private $away;
    private $home_goals;
    private $away_goals;
    private $week;
    private $status;

    private $home_name;
    private $away_name;

    private $created_at;
    private $updated_at;
    /**
     * @return mixed
     */
    public function getHomeName()
    {
        return $this->home_name;
    }

    /**
     * @param mixed $home_name
     */
    public function setHomeName($home_name): void
    {
        $this->home_name = $home_name;
    }

    /**
     * @return mixed
     */
    public function getAwayName()
    {
        return $this->away_name;
    }

    /**
     * @param mixed $away_name
     */
    public function setAwayName($away_name): void
    {
        $this->away_name = $away_name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return EntityMatch
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLeagueId()
    {
        return $this->league_id;
    }

    /**
     * @param mixed $league_id
     * @return EntityMatch
     */
    public function setLeagueId($league_id)
    {
        $this->league_id = $league_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * @param mixed $home
     * @return EntityMatch
     */
    public function setHome($home)
    {
        $this->home = $home;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAway()
    {
        return $this->away;
    }

    /**
     * @param mixed $away
     * @return EntityMatch
     */
    public function setAway($away)
    {
        $this->away = $away;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHomeGoals()
    {
        return $this->home_goals;
    }

    /**
     * @param mixed $home_goals
     * @return EntityMatch
     */
    public function setHomeGoals($home_goals)
    {
        $this->home_goals = $home_goals;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAwayGoals()
    {
        return $this->away_goals;
    }

    /**
     * @param mixed $away_goals
     * @return EntityMatch
     */
    public function setAwayGoals($away_goals)
    {
        $this->away_goals = $away_goals;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * @param mixed $week
     * @return EntityMatch
     */
    public function setWeek($week)
    {
        $this->week = $week;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return EntityMatch
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

}
