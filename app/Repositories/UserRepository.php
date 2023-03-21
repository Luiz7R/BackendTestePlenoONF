<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository {

    public $model;

    public function __construct() {
        $this->model = new User();
    }

    public function registerUser($userPayload) {
        return $this->model->create([
            'name' => $userPayload['name'],
            'email' => $userPayload['email'],  
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make($userPayload['password']),
            'remember_token' => Str::random(10),
        ]);
    }
}