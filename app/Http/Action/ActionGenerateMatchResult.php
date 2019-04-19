<?php
/**
 * Created by PhpStorm.
 * User: Hamid
 * Date: 4/19/2019
 * Time: 4:55 PM
 */

namespace App\Http\Action;


use App\Http\Entity\EntityMatch;
use App\Http\Hydrate\HydrateMatch;
use App\Http\Repository\RepositoryMatch;

class ActionGenerateMatchResult
{

    private $repositoryMatch;
    private $hydrateMatch;

    /**
     * ActionGenerateMatchResult constructor.
     * @param $repositoryMatch
     * @param $hydrateMatch
     */
    public function __construct(RepositoryMatch $repositoryMatch, HydrateMatch $hydrateMatch)
    {
        $this->repositoryMatch = $repositoryMatch;
        $this->hydrateMatch = $hydrateMatch;
    }

    public function __invoke(EntityMatch $match)
    {
        //validations

        $result = $this->repositoryMatch->setMatchResult($match);
    }

}