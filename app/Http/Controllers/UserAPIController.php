<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\EmailRepository;
use App\Http\Requests;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

class UserAPIController extends Controller
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
    
    public function getAllUsers()
    {
        $data = $this->user_repository->findAll();
        $response = [];
        foreach ($data as $key) {
            $response[] = [
                'id' => $key->id,
                'name' => $key->name,
                'email' => $key->email,
                'phone' => $key->phone,
                'occupation' => $key->occupation,
                'created_at' => strtotime(date($key->created_at)),
                'updated_at' => strtotime(date($key->updated_at))
            ];
        }

        return \Response::json(array(
            'error' => false,
            'message'=>'Get all users success',
            'data' => $response),
            200
        );
    }

    public function getUserById($id)
    {
        $data = $this->user_repository->findById($id);

        $response = [
            'id' => $data->id,
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
            'occupation' => $data->occupation,
            'created_at' => strtotime(date($data->created_at)),
            'updated_at' => strtotime(date($data->updated_at))
        ];

        return \Response::json(array(
            'error' => false,
            'message'=>'Get user id : '.$id.' success',
            'data' => $response),
            200
        );
    }

    public function create(Request $request)
    {
        $user = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:10',
            'occupation' => 'required|min:10',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(array('error' => 'Registration failed', 'message' => $validator->errors()), 200);
        }
        $result = $this->user_repository->register($user);

        if (!$result) {
            return response()->json(['error' => 'Registration failed'], 500);
        } else {
            $this->email_repository->sendEmailNotification($result);
            return \Response::json(array(
                'error' => false,
                'message' => 'Registration successfully'),
                200
            );
        }
    }
}
