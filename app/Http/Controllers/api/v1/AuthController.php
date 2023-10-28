<?php

namespace App\Http\Controllers\api\v1;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function googleLogin() {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback() {
        $user = Socialite::driver('google')->user();

        $user = User::where('external_id', $user->id)
            ->where('external_auth', 'google')
            ->first();

        if($user) {
            // Here he sould recieve the login method
        } else {
            User::create([
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'external_id' => $user->id,
                'external_auth' => 'google',
            ]);

            // after creating the user he should be logged in
        }
    }
}
