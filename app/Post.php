<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table Name
    protected $table = 'posts';
    //Primary Key
    protected $primaryKey = 'id';
    //Timestamps
    //protected $timestamps = true;
    
    //model relationships
    public function user(){
        return $this->belongsTo('App\User');
    }
}
