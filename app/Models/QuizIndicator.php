<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizIndicator extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'quiz_1',
        'quiz_2',
        'quiz_3',
        'quiz_4'
    ];

}