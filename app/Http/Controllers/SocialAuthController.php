<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SocialAuthController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $this->loginOrCreateAccount($user, 'facebook');
        return redirect()->route('home');
    }

   
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $this->loginOrCreateAccount($user, 'google');
        return redirect()->route('home');
    }

    // Login or create a new account
    protected function loginOrCreateAccount($providerUser, $provider)
    {
        $user = User::where('provider_id', $providerUser->getId())->first();

        if (!$user) {
            $user = User::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'password' => Hash::make(str_random(24)), 
                'provider' => $provider,
                'provider_id' => $providerUser->getId(),
            ]);
        }

        Auth::login($user, true);
    }
    public function login()
    {
        return view('login');
    }

}
