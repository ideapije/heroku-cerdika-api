<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Membership\Account;

class MemberSubmission extends Model
{
    use HasFactory;

    public $allow_export_all = true;

    protected $fillable = [
        'user_id',
        'question_id',
        'choice_id'
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
