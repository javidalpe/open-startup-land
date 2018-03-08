<?php

namespace App\Repositories;

use App\Startup;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StartupRepository
 * @package App\Repositories
 * @version March 8, 2018, 9:27 am UTC
 *
 * @method Startup findWithoutFail($id, $columns = ['*'])
 * @method Startup find($id, $columns = ['*'])
 * @method Startup first($columns = ['*'])
*/
class StartupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'speech',
        'website',
        'api_endpoint'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Startup::class;
    }
}
