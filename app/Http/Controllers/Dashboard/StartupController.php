<?php

namespace App\Http\Controllers\Dashboard;

use App\Commands\CheckStartup;
use App\Handlers\CommandHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStartupRequest;
use App\Http\Requests\UpdateStartupRequest;
use App\Repositories\StartupRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class StartupController extends Controller
{
    /** @var  StartupRepository */
    private $startupRepository;
    private $commandHandler;

    public function __construct(StartupRepository $startupRepo, CommandHandler $commandHandler)
    {
        $this->startupRepository = $startupRepo;
        $this->commandHandler = $commandHandler;
    }

    /**
     * Display a listing of the Startup.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->startupRepository->pushCriteria(new RequestCriteria($request));
        $startups = $this->startupRepository->all();

        return view('startups.index')
            ->with('startups', $startups);
    }

    /**
     * Show the form for creating a new Startup.
     *
     * @return Response
     */
    public function create()
    {
        return view('startups.create');
    }

    /**
     * Store a newly created Startup in storage.
     *
     * @param CreateStartupRequest $request
     *
     * @return Response
     */
    public function store(CreateStartupRequest $request)
    {
        $input = $request->all();
	    $input['user_id'] = Auth::id();
        $startup = $this->startupRepository->create($input);

        $this->commandHandler->executeCommand(new CheckStartup($startup));

        Flash::success('Startup saved successfully.');

        return redirect(route('startups.index'));
    }

    /**
     * Display the specified Startup.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $startup = $this->startupRepository->findWithoutFail($id);

        if (empty($startup)) {
            Flash::error('Startup not found');

            return redirect(route('startups.index'));
        }

        return view('startups.show')->with('startup', $startup);
    }

    /**
     * Show the form for editing the specified Startup.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $startup = $this->startupRepository->findWithoutFail($id);

        if (empty($startup)) {
            Flash::error('Startup not found');

            return redirect(route('startups.index'));
        }

        return view('startups.edit')->with('startup', $startup);
    }

    /**
     * Update the specified Startup in storage.
     *
     * @param  int              $id
     * @param UpdateStartupRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStartupRequest $request)
    {
        $startup = $this->startupRepository->findWithoutFail($id);

        if (empty($startup)) {
            Flash::error('Startup not found');

            return redirect(route('startups.index'));
        }

        $startup = $this->startupRepository->update($request->all(), $id);

        $this->commandHandler->executeCommand(new CheckStartup($startup));

        Flash::success('Startup updated successfully.');

        return redirect(route('startups.index'));
    }

    /**
     * Remove the specified Startup from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $startup = $this->startupRepository->findWithoutFail($id);

        if (empty($startup)) {
            Flash::error('Startup not found');

            return redirect(route('startups.index'));
        }

        $this->startupRepository->delete($id);

        Flash::success('Startup deleted successfully.');

        return redirect(route('startups.index'));
    }
}
