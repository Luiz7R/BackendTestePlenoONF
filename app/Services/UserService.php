<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepository;
use \Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class UserService {

use AuthorizesRequests;

    public $userRepository;
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Http\Requests\LoginRequest $request
     */
    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->validated();

         if ( Auth::attempt($credentials) )
         {      
              $request->session()->regenerate();

              Auth::user();
         }
         return ['msg' => 'Invalid Credentials','statusCode' => '401'];
    }

   /**
     * Display the specified resource.
     *
     * @param  \App\Http\Requests\RegisterRequest $request
     * @return array
     */
    public function registerUser (RegisterRequest $request)
    {
        $userPayload = $request->validated();

        $user = $this->userRepository->registerUser($userPayload);

        return ['user' => $user, 'token' => $user->createToken('')->plainTextToken];
    }

       /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request;
     * @return bool
     */
    public function logout(Request $request)
    {
          Auth::logout();

          $request->session()->invalidate();

          $request->session()->regenerateToken();

          return true;
    }
}