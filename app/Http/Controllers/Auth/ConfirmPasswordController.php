<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ConfirmPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return string
     * @throws ValidationException
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string',
        ]);

        return Hash::check($request->password, auth()->user()->password) ?
            "Password confirmed" :
            response()->json(['message' => 'Password does not match'], 403);
    }
}
