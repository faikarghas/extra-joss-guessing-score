<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PostImages extends Model
{
    //use HasFactory;
    protected $fillable = ['title','images','path','full_path','post_id','order'];
    protected $table = 'posts_images';
    protected $primaryKey = 'id';

}
