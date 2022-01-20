<?php

namespace Modules\Membership;

use Modules\Membership\Province;
use Modules\Membership\City;
use Modules\Membership\Subdistrict;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'addressable_id',
        'addressable_type',
        'province_id',
        'regency_id',
        'district_id',
        'address'
    ];

    /**
     * Get the parent addressable model.
     */
    public function addressable()
    {
        return $this->morphTo();
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class);
    }
}
