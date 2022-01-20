<?php

namespace Modules\Membership;

use Modules\Membership\Province;
use Modules\Membership\Subdistrict;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'city_type', 'province_id', 'postal_code'];
    protected $hidden = ['province_id', 'created_at', 'updated_at', 'postal_code'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function subdistricts()
    {
        return $this->hasMany(Subdistrict::class);
    }
}
