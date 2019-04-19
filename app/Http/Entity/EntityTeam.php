<?php
/**
 * Created by PhpStorm.
 * User: Hamid
 * Date: 4/19/2019
 * Time: 12:57 PM
 */

namespace App\Http\Entity;


class EntityTeam
{
    private $id;
    private $name;
    private $strength;

    private $created_at;
    private $deleted_at;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return EntityTeam
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return EntityTeam
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @param mixed $strength
     * @return EntityTeam
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;
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
    public function getDeletedAt()
    {
        return $this->deleted_at;
    }

}