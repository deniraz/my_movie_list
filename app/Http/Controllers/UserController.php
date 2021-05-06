<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware("login");
    }

    public function index()
    {
        return "Login Success!";
    }

    public function showMovie(Request $request)
    {
        $list=DB::('user-movie-list')
        ->where('user_id', $request=>user_id)
        ->get();

        return $list;
    }

    public function showWatchingList(Request $request)
    {
        $list=DB::('user-movie-list')
        ->where('user_id', $request=>user_id)
        ->where('list_category', 'watching')
        ->get();

        return $list;
    }

    public function showWatchedList(Request $request)
    {
        $list=DB::('user-movie-list')
        ->where('user_id', $request=>user_id)
        ->where('list_category', 'watched')
        ->get();

        return $list;
    }

    public function addMovie(Request $request)
    {
        $users=DB::table('user-movie-list')
        ->insert([
            'user_id'=>$request->user_id,
            'movie_id'=>$request->movie_id,
            'list_category'=>$request->list_category
        ]);
    }

    public function deleteMovie(Request $request)
    {
        $users=DB::table('user-movie-list')
        ->where('movie_id', $request->movie_id)
        ->delete();
    }

    public function changeListCategory(Request $request)
    {
        $users=DB::('user-movie-list')
        ->where('movie_id', $request->movie_id)
        ->update([
	        'list_category'=>$request->list_category
	    ]);
    }
}