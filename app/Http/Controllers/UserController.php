<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\UserRepositories;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    protected $user_repository;

    public function __construct
    (
        UserRepositories $userRepository
    )
    {
        $this->user_repository = $userRepository;
    }

    public function index()
    {
        return view('index');
    }

    public function dashboard($id)
    {
        $users = $this->user_repository->findById($id);
        return view('dashboard', compact('users'));
    }

    public function store(Request $request)
    {
        $user = $request->all();
        $this->validate($request,[
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users|min:10',
            'phone'=>'required|min:10',
            'occupation'=>'required|min:10',
            'password'=>'required|min:6',
        ]);

        $result = $this->user_repository->register($user);

        if (!$result) {
            return response()->json(['error' => 'Trending  error  while create'], 500);
        }

        return Redirect::action('UserController@dashboard', array('id' => $result->id));
    }
}
