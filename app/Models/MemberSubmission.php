<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Membership\Account;

class MemberSubmission extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'question_id',
        'choice_id'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(Account::class, 'user_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function choice()
    {
        return $this->belongsTo(Choice::class, 'choice_id', 'id');
    }
}
