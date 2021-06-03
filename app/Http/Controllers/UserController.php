<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();

        return view('users.index', compact('users', 'roles'));
    }

    public function destroyAll(Request $request){
        $user_ids = $request->input('deletedUserId');

        foreach ($user_ids as $user_id){
            $user = User::findOrFail($user_id);
            //Check if the user wants to delete himself
            if($user == Auth::user()){
                return redirect()->back()->with('error','Vous ne pouvez pas vous supprimer');
            }
            //Check if the user is really deletable
            elseif ($user->isDeletable()){
                return redirect()->back()->with('error',$user->username." n'est pas supprimable");
            }
        }
        //Soft deletes records
        User::whereIn('id', $user_ids)->delete();

        count($user_ids) < 2 ? $flashmessage = "L'utilisateur a bien été supprimé" : $flashmessage = "Les utilisateurs ont bien été supprimés" ;
        return redirect()->back()->with('success',$flashmessage);
    }
}
