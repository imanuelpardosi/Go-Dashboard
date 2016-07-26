<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;

class UserRepository
{
    public function findById($id)
    {
        $query = User::findOrFail($id);
        return $query;
    }

    public function findByEmail($email)
    {
        $query = User::where('email','=',$email)->first();
        return $query;
    }

    public function findAll()
    {
        $query = User::orderBy('id', 'asc');
        return $query->get();
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

    public function countUserRegisteredToday()
    {
        $query = User::select(DB::raw('count(*) as user_count'))
            ->whereRaw(('DATE(created_at) = curdate()'))
            ->get();

        return $query;
    }
}
