<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Metric
 * @package App
 * @version March 8, 2018, 11:18 am UTC
 *
 * @property \App\Startup startup
 * @property integer monthly_revenue
 * @property integer paid_users
 * @property integer free_users
 * @property date recorded_at
 * @property integer startup_id
 */
class Metric extends Model
{

    public $table = 'metrics';
    


    public $fillable = [
        'monthly_revenue',
        'paid_users',
        'free_users',
        'recorded_at',
        'startup_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'monthly_revenue' => 'integer',
        'paid_users' => 'integer',
        'free_users' => 'integer',
        'recorded_at' => 'date',
        'startup_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'monthly_revenue' => 'required|numeric',
        'paid_users' => 'required|numeric',
        'free_users' => 'required|numeric'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function startup()
    {
        return $this->belongsTo(\App\Startup::class);
    }
}
