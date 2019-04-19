<?php
/**
 * Created by PhpStorm.
 * User: Hamid
 * Date: 4/19/2019
 * Time: 6:25 PM
 */

namespace App\Http\Controllers;


use App\Http\Action\ActionGetWeekMatches;
use App\Http\Action\ActionSetMatchResult;
use App\Http\Entity\EntityMatch;
use App\Http\Hydrate\HydrateMatch;

/**
 * Class HttpGetweekMatches
 * @package App\Http\Controllers
 */
class HttpGetWeekMatches
{

    /**
     * @var ActionGetWeekMatches
     */
    private $actionGetWeekMatches;
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
    public function __construct(ActionGetWeekMatches$actionGetWeekMatches, ActionSetMatchResult $actionSetMatchResult, HydrateMatch $hydrateMatch)
    {
        $this->actionGetWeekMatches = $actionGetWeekMatches;
        $this->actionSetMatchresult = $actionSetMatchResult;
        $this->hydrateMatch = $hydrateMatch;
    }

    /**
     * @param $week_number
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($week_number)
    {
        $matches = $this->actionGetWeekMatches->__invoke($week_number);

        if($matches)
        {
            /** @var EntityMatch $match */
            foreach ($matches as $index => $match)
            {
                if($match->getStatus() == 0)
                {
                    $match = $this->actionSetMatchresult->__invoke($match);
                }

                $matches[$index] = $this->hydrateMatch->fromEntity($match)->toArray();
            }
        }

        return response()->json($matches, 201);

    }

}