<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
  public $userService;


  public function __construct(UserService $userService) {
    $this->userService = $userService;
  }

   /**
     * Display the specified resource.
     *
     * @param  \App\Http\Requests\LoginRequest $request

     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->to('/homepage');
        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

   /**
     * Display the specified resource.
     *
     * @param  \App\Http\Requests\RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerUser (RegisterRequest $request)
    {
          $user = $this->userService->registerUser($request);

          return response()->json($user,201);
    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Http\Requests\RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout (Request $request)
    {
          $this->userService->logout($request);

          return redirect()->to('/');
    }
}
