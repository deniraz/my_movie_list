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
        // $list=DB::table('user-movie-list')
        // ->where('user_id', $request=>user_id)
        // ->get();
        // return $list;

        $user_id=DB::table('users')
        ->select('id')
        ->where('token', $request->token)
        ->pluck('id');
        
        $users=DB::table('user-movie-list')
        ->where([
            'user_id'=>$user_id[0],
        ])
        ->get();
        return $users;
        // return response()->json(['result' => $users]);
    }

    // public function showWatchingList(Request $request)
    // {
    //     $list=DB::table('user-movie-list')
    //     ->where('user_id', $request=>user_id)
    //     ->where('list_category', 'watching')
    //     ->get();

    //     return $list;
    // }

    // public function showWatchedList(Request $request)
    // {
    //     $list=DB::table('user-movie-list')
    //     ->where('user_id', $request=>user_id)
    //     ->where('list_category', 'watched')
    //     ->get();

    //     return $list;
    // }

    public function addMovie(Request $request)
    {   
        $user_id=DB::table('users')
        ->select('id')
        ->where('token', $request->token)
        ->pluck('id');
        
        $users=DB::table('user-movie-list')
        // ->join('user', 'user-movie-list.user_id', 'user.id')
        // ->where('token', $request->token)
        ->insert([
            'user_id'=>$user_id[0],
            'movie_id'=>$request->movie_id,
            'list_category'=>$request->list_category
        ]);
        return response()->json(['result' => $users]);
        // return $user_id;
        // $results = DB::select("SELECT id FROM 'users' WHERE 'token' = $request->token");
        // return $results;
    }

    public function deleteMovie(Request $request)
    {
        // $users=DB::table('user-movie-list')
        // ->where('movie_id', $request->movie_id)
        // ->delete();

        $user_id=DB::table('users')
        ->select('id')
        ->where('token', $request->token)
        ->pluck('id');
        
        $users=DB::table('user-movie-list')
        // ->join('user', 'user-movie-list.user_id', 'user.id')
        ->where([
            'user_id'=>$user_id[0],
            'movie_id'=>$request->movie_id,
            //['list_category'=>$request->list_category],
        ])
        ->delete();
        return response()->json(['result' => $users]);
    }

    public function changeListCategory(Request $request)
    {
        // $users=DB::table('user-movie-list')
        // ->where('movie_id', $request->movie_id)
        // ->update([
	    //     'list_category'=>$request->list_category
	    // ]);
    }
}