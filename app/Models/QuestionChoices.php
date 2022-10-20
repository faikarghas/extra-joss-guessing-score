<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionChoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'choice',
        'point',
    ];

    public function question()
    {
        //return $this->belongsTo(Question::class, 'question_id', 'question_id');
        return $this->hasOne(Question::class, 'id', 'question_id');
    }
    
}
 