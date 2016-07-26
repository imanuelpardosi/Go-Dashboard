<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Routing\ResponseFactory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;
use App\Models\User;

class AuthController extends Controller
{
    private $responseFactory;
    private $auth;
    private $user_repository;

    public function __construct(ResponseFactory $responseFactory, Guard $auth, UserRepository $userRepository)
    {
        $this->responseFactory = $responseFactory;
        $this->auth=$auth;
        $this->user_repository = $userRepository;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //dd($credentials);
        //var_dump($this->auth->attempt($credentials));
        //echo Hash::make("imanuel123");

        if (\Auth::attempt($credentials)) {
            $user = $this->user_repository->findByEmail($request->input('email'));
            $response = [
                'error' => false,
                'message' => $user
            ];
            return response()->json($response, 200);
        } else {
            return response()->json(['error' => 'Login failed'], 401);
        }
    }

}
