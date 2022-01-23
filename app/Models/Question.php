<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['text', 'group'];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function choices()
    {
        return $this->belongsToMany(Choice::class)->using(ChoiceQuestion::class)->withPivot('score');
    }
}
