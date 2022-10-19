<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fmatch extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_team_a',
        'id_team_b',
        'score_a',
        'score_b',
        'matchday',
        'round',
        'match_status',
        'expired_time',
        'match_time'
    ];
    public function countries_one()
    {
        return $this->belongsTo(Countries::class,'id_team_a','id');
    }
    public function countries_two()
    {
        return $this->belongsTo(Countries::class,'id_team_b','id');
    }
    public function round_match()
    {
        return $this->belongsTo(Round::class,'round','id');
    }
}
