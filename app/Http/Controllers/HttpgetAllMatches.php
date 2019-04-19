<?php
/**
 * Created by PhpStorm.
 * User: Hamid
 * Date: 4/19/2019
 * Time: 6:25 PM
 */

namespace App\Http\Controllers;


use App\Http\Action\ActionGetAllMatches;
use App\Http\Action\ActionSetMatchResult;
use App\Http\Entity\EntityMatch;
use App\Http\Hydrate\HydrateMatch;

/**
 * Class HttpGetweekMatches
 * @package App\Http\Controllers
 */
class HttpGetAllMatches
{

    /**
     * @var ActionGetAllMatches
     */
    private $actionGetAllMatches;
    /**
     * @var ActionSetMatchResult
     */
    private $actionSetMatchresult;

    /**
     * @var HydrateMatch
     */
    private $hydrateMatch;

    //private $action
    /**
     * HttpGetweekMatches constructor.
     * @param $actionGetWeekMatches
     */
    public function __construct(ActionGetAllMatches $actionGetAllMatches, ActionSetMatchResult $actionSetMatchResult, HydrateMatch $hydrateMatch)
    {
        $this->actionGetAllMatches = $actionGetAllMatches;
        $this->actionSetMatchresult = $actionSetMatchResult;
        $this->hydrateMatch = $hydrateMatch;
    }

    /**
     * @param $week_number
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        $matches = $this->actionGetAllMatches->__invoke();

        if($matches)
        {
            /** @var EntityMatch $match */
            foreach ($matches as $index => $match)
            {
                $matches[$index] = $this->hydrateMatch->fromEntity($match)->toArray();
            }
        }

        return response()->json($matches, 201);

    }

}