<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function register(UserRegistrationRequest $request)
    {

        try {

                // Si se quiere guardar un user de rol root solo lo puede hacer un rol hablitado para eso ( solo root)
            if ($request->rol===Rol::ROOT){
                $this->authorize('register_user_root');
            }

            $this->authorize('register_user');
            $user = User::create($request->all());


            $rootRole = Role::where('name', $request->rol)->where('guard_name', 'api')->firstOrFail();
            $user->assignRole($rootRole);


            return apiwrapper()->ok($user);
        }catch (\Exception $e){
            return apiwrapper()->internalServerError($e->getMessage());
        }


    }


}


