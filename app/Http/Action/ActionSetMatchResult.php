<?php
/**
 * Created by PhpStorm.
 * User: Hamid
 * Date: 4/19/2019
 * Time: 6:40 PM
 */

namespace App\Http\Action;


use App\Http\Entity\EntityMatch;
use App\Http\Hydrate\HydrateMatch;
use App\Http\Repository\RepositoryMatch;

/**
 * Class ActionSetMatchResult
 * @package App\Http\Action
 */
class ActionSetMatchResult
{

    /**
     * @var RepositoryMatch
     */
    private $repositoryMatch;
    /**
     * @var HydrateMatch
     */
    private $hydMatch;

    /**
     * ActionSetMatchResult constructor.
     * @param $repositoryMatch
     * @param $hydMatch
     */
    public function __construct(RepositoryMatch $repositoryMatch, HydrateMatch $hydMatch)
    {
        $this->repositoryMatch = $repositoryMatch;
        $this->hydMatch = $hydMatch;
    }

    /**
     * @param EntityMatch $match
     * @return EntityMatch
     */
    public function __invoke(EntityMatch $match)
    {
        return $this->repositoryMatch->setMatchResult($match);
    }

}