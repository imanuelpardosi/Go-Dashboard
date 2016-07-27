<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\UserRepository;
use App\Repositories\EmailRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Auth;
use Illuminate\Contracts\Auth\Guard;

class UserController extends Controller
{
    protected $user_repository;
    protected $email_repository;
    protected $user_id;

    public function __construct
    (
        UserRepository $userRepository,
        EmailRepository $emailRepository
    )
    {
        $this->user_repository = $userRepository;
        $this->email_repository = $emailRepository;
    }

    public function index()
    {
        //echo $this->user_repository->countUserRegisteredToday();
        
        return view('index');
    }

    public function dashboard()
    {
        $id = Session::get('id');
        $users = $this->user_repository->findById($id);
        return view('dashboard', compact('users'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (\Auth::attempt($credentials)) {
            $user = $this->user_repository->findByEmail($request->input('email'));
            Session::set('id', $user->id);
            return Redirect::action('UserController@dashboard');
        } else {
            return Redirect::back()->withErrors("Login Failed, Please Try Again.");
        }
    }

    public function store(Request $request)
    {
        $user = $request->all();
        $this->validate($request,[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:5',
            'occupation' => 'required|min:5',
            'password' => 'required|min:6',
        ]);

        $result = $this->user_repository->register($user);

        if (!$result) {
            return Redirect::back()->withErrors("Registration Failed, Please Try Again.");
        } else {
            $this->email_repository->sendEmailNotification($result);
            Session::set('id', $result->id);
            return Redirect::action('UserController@dashboard');
        }
    }
}
