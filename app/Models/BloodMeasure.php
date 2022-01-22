<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Membership\Account;

class BloodMeasure extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'date_sistolik', 'sistolik',
        'date_diastolik', 'diastolik'
    ];
    protected $appends = ['sistolik_formatted', 'diastolik_formatted'];

    public function user()
    {
        return $this->belongsTo(Account::class, 'user_id', 'id');
    }

    public function getSistolikFormattedAttribute()
    {
        return "{$this->sistolik} mmHg";
    }

    public function getDiastolikFormattedAttribute()
    {
        return "{$this->diastolik} mmHg";
    }
}
