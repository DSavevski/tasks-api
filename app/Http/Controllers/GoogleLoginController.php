<?php

namespace App\Http\Controllers;

use App\User;
use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GoogleLoginController extends Controller
{
    public function getSignInToken(Request $request)
    {

        $id_token = $request->input('id_token');
        $client = new Google_Client(['client_id' => env('CLIENT_ID')]);  // Specify the CLIENT_ID of the app that accesses the backend
        $payload = $client->verifyIdToken($id_token);

        if ($payload) {
            $user = User::where('email', $payload['email'])->first();
            if (is_null($user)) {
                $user = new User;
                $user->name = $payload['name'];
                $user->email = $payload['email'];
                $user->save();
            }
            Auth::login($user, true);
            return response('Successfully logged in', 200);

        } else {
            // Invalid ID token
            return response('Invalid ID token', 500);
        }
    }

    public function signOut(Request $request){
        Auth::logout();
        return response(Auth::user());
    }
}
