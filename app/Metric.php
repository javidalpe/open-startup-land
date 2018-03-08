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

    const MONTHLY_REVENUE = 'monthly_revenue';
    const PAID_USERS = 'paid_users';
    const FREE_USERS = 'free_users';


    public $fillable = [
        self::MONTHLY_REVENUE,
        self::PAID_USERS,
        self::FREE_USERS,
        'recorded_at',
        'startup_id'
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        self::MONTHLY_REVENUE => 'integer',
        self::PAID_USERS => 'integer',
        self::FREE_USERS => 'integer',
        'recorded_at' => 'date',
        'startup_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        self::MONTHLY_REVENUE => 'required|numeric',
        self::PAID_USERS => 'required|numeric',
        self::FREE_USERS => 'required|numeric'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function startup()
    {
        return $this->belongsTo(\App\Startup::class);
    }
}
