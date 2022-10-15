<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'desc',
        'image_desktop',
        'image_desktop_path',
        'image_mobile',
        'image_mobile_path',
        'user_id'
      
    ];    
}
 