<?php
/**
 * Created by PhpStorm.
 * User: Hamid
 * Date: 4/19/2019
 * Time: 1:18 PM
 */

namespace App\Http\Action;


use App\Http\Entity\EntityTeam;
use App\Http\Hydrate\HydrateTeam;
use App\Http\Repository\RepositoryTeam;
use App\Http\Validation\ValidationTeam;

/**
 * Class ActionCreateTeam
 * @package App\Http\Action
 */
class ActionCreateTeam
{

    /**
     * @var ValidationTeam
     */
    private $validationTeam;

    /**
     * @var RepositoryTeam
     */
    private $repositoryTeam;

    /**
     * @var HydrateTeam
     */
    private $hydrateTeam;

    /**
     * ActionCreateTeam constructor.
     * @param $validationTeam
     * @param RepositoryTeam $repositoryTeam
     */
    public function __construct(ValidationTeam $validationTeam, RepositoryTeam $repositoryTeam, HydrateTeam $hydrateTeam)
    {
        $this->validationTeam = $validationTeam;
        $this->repositoryTeam = $repositoryTeam;
        $this->hydrateTeam = $hydrateTeam;
    }

    /**
     * @param EntityTeam $entityTeam
     * @return EntityTeam
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(EntityTeam $entityTeam)
    {

        $this->validationTeam->storeTeam($this->hydrateTeam->fromEntity($entityTeam)->toArray());

        $entityTeam = $this->repositoryTeam->store($entityTeam);

        return $entityTeam;
    }

}