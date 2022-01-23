<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'text'];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class)->using(ChoiceQuestion::class)->withPivot('score');
    }
}
