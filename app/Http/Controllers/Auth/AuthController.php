<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\Controller;
use App\Models\User;
use PhpParser\Builder;


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
            return Socialite::with('azure')->with(["prompt" => "select_account"])->redirect();
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
     * @param $azureUser
     * @return User
     */
    private function findOrCreateUser($azureUser)
    {
        $authUser = User::where('email', '=', $azureUser->email)->first();
        if (!$authUser) {
            $newComer = new User();
            $newComer->username = $azureUser->user['displayName'];
            $newComer->email = $azureUser->email;
            $newComer->password = "0000"; //TODO Delete password field in DB (if no usage)
            $newComer->role_id = 3;
            $newComer->first_name = $azureUser->user['givenName'];
            $newComer->last_name = $azureUser->user['surname'];
            $newComer->save();
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
