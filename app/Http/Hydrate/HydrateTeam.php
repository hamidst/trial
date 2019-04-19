<?php
/**
 * Created by PhpStorm.
 * User: Hamid
 * Date: 4/19/2019
 * Time: 1:03 PM
 */

namespace App\Http\Hydrate;


use App\Http\Entity\EntityTeam;
use App\Team;

/**
 * Class HydrateTeam
 * @package App\Http\Hydrate
 */
class HydrateTeam
{

    /**
     * @var
     */
    private $teamEntity;

    /**
     * @param array $arrayTeam
     * @return HydrateTeam
     */
    function fromArray(array $arrayTeam) : HydrateTeam
    {
        $this->teamEntity = $this->arrayToEntity($arrayTeam);

        return $this;
    }

    /**
     * @return array
     */
    function toArray() : array
    {
        return $this->entityToArray($this->teamEntity);
    }

    /**
     * @param EntityTeam $entityTeam
     * @return HydrateTeam
     */
    function fromEntity(EntityTeam $entityTeam) : HydrateTeam
    {
        $this->teamEntity = $entityTeam;

        return $this;
    }


    /**
     * @return EntityTeam
     */
    function toEntity() : EntityTeam
    {
        return $this->teamEntity;
    }

    /**
     * @param EntityTeam $entityTeam
     * @return array
     */
    private function entityToArray(EntityTeam $entityTeam) : array
    {

        $arr = [
            'name' => $entityTeam->getName(),
            'strength' => $entityTeam->getStrength()
        ];

        if (!empty($entityTeam->getId())) {
            $arr['id'] = $entityTeam->getId();
        }

        return $arr;
    }

    /**
     * @param array $arrayTeam
     * @return EntityTeam
     */
    private function arrayToEntity(array $arrayTeam) : EntityTeam
    {
        $entityTeam = new EntityTeam();

        if (array_key_exists('id', $arrayTeam)) {
            $entityTeam->setId($arrayTeam['id']);
        }

        if (array_key_exists('name', $arrayTeam)) {
            $entityTeam->setName($arrayTeam['name']);
        }

        if (array_key_exists('strength', $arrayTeam)) {
            $entityTeam->setStrength($arrayTeam['strength']);
        }

        return $entityTeam;
    }

    /**
     * @param Team $modelTeam
     * @return EntityTeam
     */
    function modelToEntity(Team $modelTeam) : EntityTeam
    {
        $teamArray = $modelTeam->toArray();

        $this->teamEntity = $this->arrayToEntity($teamArray);
        return $this->teamEntity;
    }

}