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
        'point'
    ];

    protected $table = 'question_choices';

    public function question()
    {
        return $this->belongsTo(Questions::class);
    }
    
}
 