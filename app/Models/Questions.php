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


    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    // public function postImages()
    // {
    //     return $this->belongsToMany(PostImages::class);
    // }

    
}
 