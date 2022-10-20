<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
    ];


    public function choices()
    {
        return $this->hasMany(QuestionChoices::class,'question_id','id');
    }

    public function correctChoicesCount() {
        return $this->choices()->where('correct', 1 )->count();
    }

    public function correctChoicesOptions() {
       return  $this->choices()->where('correct', 1)->get();
    }

    
}
 