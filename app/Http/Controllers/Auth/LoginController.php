<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        abort_if(is_null($user), 401, 'Email or Password is Incorrect.');

        abort_if(!Hash::check($request->password, $user->password), 401, 'Email or Password is Incorrect.');

        $user->token = $user->createToken(config('app.secret_key'))->plainTextToken; // create & assign token

        return $user;
    }
}
