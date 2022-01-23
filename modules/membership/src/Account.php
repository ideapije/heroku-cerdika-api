<?php

namespace Modules\Membership;

use App\Models\BloodMeasure;
use App\Models\MemberSubmission;
use App\Models\User;
use Illuminate\Auth\MustVerifyEmail;

class Account extends User
{
    use MustVerifyEmail;
    protected $table = 'users';

    public function membership()
    {
        return $this->hasOne(Member::class, 'user_id', 'id');
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function submissions()
    {
        return $this->hasMany(MemberSubmission::class, 'user_id', 'id');
    }

    public function bloodMeasures()
    {
        return $this->hasMany(BloodMeasure::class, 'user_id', 'id');
    }
}
