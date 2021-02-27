<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public static function getAllUsers(){
        $users = User::with('role', 'promocode')->get();
        return $users;
    }

    public function findUsers(Request $request)
    {
        if(!isset($request->adminUserSearchName) && !isset($request->adminUserSearchDate)){
            return redirect(route('admin.users'));
        }
        $query = User::with('role');
        if(isset($request->adminUserSearchName)){
          $query->where('name', 'LIKE', '%' . $request->adminUserSearchName . '%')
                ->orWhere('email', 'LIKE', '%' . $request->adminUserSearchName . '%');
        }
        if(isset($request->adminUserSearchDate)){
            $query->where('created_at', 'LIKE', '%' . $request->adminUserSearchDate . '%');
        }
        return view('admin.users', ['users' => $query->get()]);

    }
    public function deleteUser($id){
        $user = User::find($id);
        $user->softdelete();
        return redirect(route('admin.users'));
    }
}
