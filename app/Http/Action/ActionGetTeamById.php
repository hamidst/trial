<?php
/**
 * Created by PhpStorm.
 * User: Hamid
 * Date: 4/19/2019
 * Time: 10:55 PM
 */

namespace App\Http\Action;


use App\Http\Entity\EntityTeam;
use App\Http\Hydrate\HydrateTeam;
use App\Http\Repository\RepositoryTeam;

class ActionGetTeamById
{

    private $hydrateTeam;
    private $repositoryTeam;

    /**
     * ActionGetTeamById constructor.
     * @param $hydrateTeam
     * @param $repositoryTeam
     */
    public function __construct(HydrateTeam $hydrateTeam, RepositoryTeam $repositoryTeam)
    {
        $this->hydrateTeam = $hydrateTeam;
        $this->repositoryTeam = $repositoryTeam;
    }

    public function __invoke($teamId) : EntityTeam
    {
        return $this->repositoryTeam->get($teamId);
    }
}