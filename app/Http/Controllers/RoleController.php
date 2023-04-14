<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function roles(){
        $roles = Role::all();
        return $roles;
        return view('roles', ['roles'=>$roles]);
    }

    public function role($id){
        $role = Role::find($id);
        return $role;
        return view('role', ['role'=>$role]);
    }
}
