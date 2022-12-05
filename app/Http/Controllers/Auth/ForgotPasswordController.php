<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function __invoke(Request $request)
    {
        // validate
        $this->validate($request, [
            'phone' => 'required|string',
        ]);

        $user = User::where('phone', $request->phone)->first();

        abort_if(!$user, 403, 'User not found');

        return 'An email is has been sent.';
    }
}
