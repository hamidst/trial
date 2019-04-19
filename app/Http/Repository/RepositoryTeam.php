<?php
/**
 * Created by PhpStorm.
 * User: Hamid
 * Date: 4/19/2019
 * Time: 1:01 PM
 */

namespace App\Http\Repository;


use App\Http\Entity\EntityTeam;
use App\Http\Hydrate\HydrateTeam;
use App\Team;

/**
 * Class RepositoryTeam
 * @package App\Http\Repository
 */
class RepositoryTeam
{
    /**
     * @var Team
     */
    private $modelTeam;
    /**
     * @var HydrateTeam
     */
    private $hydrateTeam;

    /**
     * RepositoryTeam constructor.
     * @param $modelTeam
     * @param $entityTeam
     */
    public function __construct(Team $modelTeam, HydrateTeam $hydrateTeam)
    {
        $this->modelTeam = $modelTeam;
        $this->hydrateTeam = $hydrateTeam;
    }

    /**
     * @param EntityTeam $entityTeam
     * @return EntityTeam
     */
    public function store(EntityTeam $entityTeam) : EntityTeam
    {

        $this->modelTeam->newInstance()->fill($this->hydrateTeam->fromEntity($entityTeam)->toArray())->save();

        $entityTeam->setId($this->modelTeam->id);

        return $entityTeam;

    }

    /**
     * @param $teamId
     * @return EntityTeam
     */
    public function get($teamId)
    {
        $team = $this->modelTeam->newQuery()->find($teamId);
        return $this->hydrateTeam->modelToEntity($team);
    }

    /**
     * @param EntityTeam $entityTeam
     */
    public function update(EntityTeam $entityTeam)
    {

    }

    /**
     * @param EntityTeam $entityTeam
     */
    public function delete(EntityTeam $entityTeam)
    {

    }

}