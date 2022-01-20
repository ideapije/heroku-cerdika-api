<?php

namespace Modules\Membership;

use Modules\Membership\City;
use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'city_id', 'postal_code'];
    protected $hidden   = ['created_at', 'updated_at'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
