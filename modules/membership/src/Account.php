<?php

namespace Modules\Membership;

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
}
