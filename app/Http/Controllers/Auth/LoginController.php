<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return $this->unauthorized();
        }

        return $this->response([
            "token" => $token,
            "user" => \Auth::user()
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return $this->response('Successfully logged out');
    }

    public function refresh()
    {
        return $this->response(auth()->refresh());
    }

    function unauthorized(){
        return $this->response("Unauthorized",401);
    }

}
