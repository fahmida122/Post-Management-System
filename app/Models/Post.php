<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //   userr hasMany post
    //  posts belongsTo user
	public function user(){ 
         return $this->belongsTo(User::class); 
        }

     
    public function Category(){
        return $this->belongsTo(Category::class);
    } 


}
  