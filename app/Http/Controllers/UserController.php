<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function allUsers()
    {
         return response()->json(['users' =>  User::all()], 200);
    }

     /**
     * Get one user.
     *
     * @return Response
     */
    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json(['user' => $user], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'user not found!'], 404);
        }
    }

    public function showMovie(Request $request)
    {
        $user_id = Auth::user()->id;
        $users=DB::table('user-movie-list')
        ->where([
            'user_id'=>$user_id,
        ])
        ->get();
        return $users;
        // return response()->json(['result' => $users]);
    }

    public function showWatchingList(Request $request)
    {
        $user_id = Auth::user()->id;
        $list=DB::table('user-movie-list')
        ->where('user_id', $user_id)
        ->where('list_category', 'watching')
        ->get();

        return $list;
    }

    public function showWatchedList(Request $request)
    {
        $user_id = Auth::user()->id;
        $list=DB::table('user-movie-list')
        ->where('user_id', $user_id)
        ->where('list_category', 'watched')
        ->get();

        return $list;
    }

    public function addMovie(Request $request)
    {   
        $user_id = Auth::user()->id;
        $users=DB::table('user-movie-list')
        
        ->insert([
            'user_id'=>$user_id,
            'movie_id'=>$request->movie_id,
            'list_category'=>$request->list_category
        ]);
        return response()->json(['result' => $users]);

        // $user = Auth::userOrFail();
        // return $user;
    }

    public function deleteMovie(Request $request)
    {
        // $users=DB::table('user-movie-list')
        // ->where('movie_id', $request->movie_id)
        // ->delete();

        $user_id = Auth::user()->id;
        
        $users=DB::table('user-movie-list')
        // ->join('user', 'user-movie-list.user_id', 'user.id')
        ->where([
            'user_id'=>$user_id,
            'movie_id'=>$request->movie_id,
            //['list_category'=>$request->list_category],
        ])
        ->delete();
        return response()->json(['result' => $users]);
    }

    public function changeListCategory(Request $request)
    {
        $user_id = Auth::user()->id;
        $users=DB::table('user-movie-list')
        ->where([
            'user_id'=>$user_id,
            'movie_id'=>$request->movie_id,
        ])
        ->update([
	        'list_category'=>$request->list_category
	    ]);

        return response()->json(['result' => $users]);
    }
}