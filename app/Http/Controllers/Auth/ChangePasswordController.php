<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ChangePasswordController extends Controller
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
        // validate request
        $this->validate($request, [
            'password' => 'required|string',
            'new_password' => 'required|string|confirmed|min:6',
        ]);

        abort_if(!Hash::check($request->password, auth()->user()->password), 401, 'Credentials are incorrect');

        auth()->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return 'Password changed successfully';
    }
}
