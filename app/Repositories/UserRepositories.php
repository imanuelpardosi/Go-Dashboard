<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepositories
{
    public function findById($id)
    {
        $query = User::findOrFail($id);
        return $query;
    }

    public function register(array $data)
    {

        $user = new User();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->occupation = $data['occupation'];
        $user->password = Hash::make($data['password']);

        return $user->save() ? $user : false;
    }
}
