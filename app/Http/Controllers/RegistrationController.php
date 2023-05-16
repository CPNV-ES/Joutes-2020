<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class RegistrationController extends Controller
{
    public function index()
    {
        $requiredUnregisteredUsers = User::where('required', true)->where('role_id', 3)->doesnthave('teamUser')->get();
        $unregisteredUsers = User::doesnthave('teamUser')->where('role_id', 3)->get();
        $requiredRegisteredUsers = User::where('required', true)->where('role_id', 3)->has('teamUser')->get();
        $registeredUsers = User::has('teamUser')->where('role_id', 3)->get();

        return view('users.registration', compact('requiredUnregisteredUsers', 'unregisteredUsers', 'requiredRegisteredUsers', 'registeredUsers'));
    }
}
