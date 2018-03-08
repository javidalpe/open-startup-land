<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStartupAPIRequest;
use App\Http\Requests\API\UpdateStartupAPIRequest;
use App\Startup;
use App\Repositories\StartupRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class StartupController
 * @package App\Http\Controllers\API
 */

class StartupAPIController extends AppBaseController
{
    /** @var  StartupRepository */
    private $startupRepository;

    public function __construct(StartupRepository $startupRepo)
    {
        $this->startupRepository = $startupRepo;
    }

    /**
     * Display a listing of the Startup.
     * GET|HEAD /startups
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->startupRepository->pushCriteria(new RequestCriteria($request));
        $this->startupRepository->pushCriteria(new LimitOffsetCriteria($request));
        $startups = $this->startupRepository->all();

        return $this->sendResponse($startups->toArray(), 'Startups retrieved successfully');
    }

    /**
     * Store a newly created Startup in storage.
     * POST /startups
     *
     * @param CreateStartupAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateStartupAPIRequest $request)
    {
        $input = $request->all();

        $startups = $this->startupRepository->create($input);

        return $this->sendResponse($startups->toArray(), 'Startup saved successfully');
    }

    /**
     * Display the specified Startup.
     * GET|HEAD /startups/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Startup $startup */
        $startup = $this->startupRepository->findWithoutFail($id);

        if (empty($startup)) {
            return $this->sendError('Startup not found');
        }

        return $this->sendResponse($startup->toArray(), 'Startup retrieved successfully');
    }

    /**
     * Update the specified Startup in storage.
     * PUT/PATCH /startups/{id}
     *
     * @param  int $id
     * @param UpdateStartupAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStartupAPIRequest $request)
    {
        $input = $request->all();

        /** @var Startup $startup */
        $startup = $this->startupRepository->findWithoutFail($id);

        if (empty($startup)) {
            return $this->sendError('Startup not found');
        }

        $startup = $this->startupRepository->update($input, $id);

        return $this->sendResponse($startup->toArray(), 'Startup updated successfully');
    }

    /**
     * Remove the specified Startup from storage.
     * DELETE /startups/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Startup $startup */
        $startup = $this->startupRepository->findWithoutFail($id);

        if (empty($startup)) {
            return $this->sendError('Startup not found');
        }

        $startup->delete();

        return $this->sendResponse($id, 'Startup deleted successfully');
    }
}
