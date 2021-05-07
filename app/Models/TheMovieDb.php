<?php

use Illuminate\Database\Eloquent\Model;

class TheMovieDb extends Model 
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $Required = [
        'movie_id', 'list_category', 'user_id', 
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}