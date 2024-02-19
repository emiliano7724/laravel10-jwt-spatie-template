<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        try {


            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $token = auth()->attempt($credentials);
                $refreshToken = JWTAuth::fromUser(auth()->user());

                return apiwrapper()->ok(['user'=>auth()->user(),'token'=>$token,'refreshToken'=>$refreshToken],"Usuario autenticado",);

        }


        } catch (\Throwable $th) {

            return apiwrapper()->internalServerError($th->getMessage());
        }
        return  apiwrapper()->badRequest("Credeciales incorrectas");

    }


}
