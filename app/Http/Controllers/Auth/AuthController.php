<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\Controller;
use App\User;




class AuthController extends Controller
{
    /**
     * Redirect the user to the Azure authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        if(env('USER_ID'))
        {
            $this->localLogin(env('USER_ID'));
            return Redirect::to('/');
        }
        else
        {
            return Socialite::driver('azure')->redirect();
        }
    }

    /**
     * Obtain the user information from Azure.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('azure')->user();
        } catch (Exception $e) {
            return Redirect::to('/auth/azure');
        }

        $authUser = $this->findOrCreateUser($user);
        if(!empty($authUser)){
            Auth::login($authUser);
        }else{
            return Redirect::to('/')->withErrors(['Votre utilisateur ne fait pas parti de l\'application']);;
        }
        return Redirect::to('/');
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser($azureUser)
    {
        $email = $azureUser->email;
        $authUser = User::whereHas('users',function($q) use ($email) {$q->where('value', $email);})->first();
        if (!$authUser) {
            $newComer = new User();
            $newComer->username = "default"; //TODO Change default with intranet abreviation like WHN
            $newComer->email = $email;
            $newComer->password = "0000"; //TODO Delete password filed in the DB
            $newComer->role_id = "0"; //TODO Function getting status of the user in Intranet to set permissions
            $newComer->first_name = $azureUser->user['givenName'];
            $newComer->last_name = $azureUser->user['surname'];
            $newComer->save();;
            $authUser = $newComer;
        }
        return $authUser;
    }

    public function localLogin($id){
        $authUser = User::find($id);
        Auth::login($authUser);
    }

    public function logoutUser(){
        Auth::logout();
        return Redirect::to('/');
    }
}
