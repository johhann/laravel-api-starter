<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class NewPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return bool
     * @throws ValidationException
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|exists:users,email',
            'password' => 'required|confirmed'
        ]);

        $user = User::where('email', $request->email)->first();

        abort_if(! $user, 401, 'User not found.');

        $user->password = Hash::make($request->password);
        $user->save();

        return true;
    }
}
