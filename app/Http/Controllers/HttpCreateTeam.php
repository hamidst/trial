<?php

namespace App\Http\Controllers;

use App\Http\Action\ActionCreateTeam;
use App\Http\Hydrate\HydrateTeam;
use App\Http\Repository\RepositoryTeam;
use App\Http\Validation\ValidationTeam;
use Illuminate\Http\Request;

/**
 * Class httpCreateTeam
 * @package App\Http\Controllers
 */
class httpCreateTeam extends Controller
{
    /**
     * @var HydrateTeam
     */
    private $hydrateTeam;

    private $actionCreateTeam;

    /**
     * httpCreateTeam constructor.
     * @param $hydrateTeam
     */
    public function __construct(HydrateTeam $hydrateTeam, ActionCreateTeam $actionCreateTeam)
    {
        $this->hydrateTeam = $hydrateTeam;
        $this->actionCreateTeam = $actionCreateTeam;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke()
    {

        $inputsData = request()->all();

        $entityTeam = $this->actionCreateTeam->__invoke($this->hydrateTeam->fromArray($inputsData)->toEntity());

        return response()->json($this->hydrateTeam->fromEntity($entityTeam)->toArray(), 201);

    }
}
