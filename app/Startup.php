<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Startup
 * @package App
 * @version March 8, 2018, 9:27 am UTC
 *
 * @property \App\User user
 * @property \Illuminate\Database\Eloquent\Collection Metric
 * @property string name
 * @property string speech
 * @property string website
 * @property string api_endpoint
 * @property string currency
 * @property integer user_id
 */
class Startup extends Model
{

    public $table = 'startups';
    


    public $fillable = [
        'name',
        'speech',
        'website',
        'api_endpoint',
        'status',
        'currency',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'speech' => 'string',
        'website' => 'string',
        'api_endpoint' => 'string',
        'status' => 'boolean',
        'currency' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|min:2|max:80',
        'speech' => 'required|min:4|max:140',
        'website' => 'required|min:2|max:80',
        'api_endpoint' => 'required|min:2|max:80',
        'currency' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function metrics()
    {
        return $this->hasMany(\App\Metric::class);
    }


    public function scopeReady($query) {
        return $query->where('status', true);
    }
}
