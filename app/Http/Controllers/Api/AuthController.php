<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthController extends Controller
{
    public function login(Request $request)
    {

    }

    public function register(Request $request)
    {
        return response([
            'success' => true,
            'message' => 'register'
        ]);
    }
}
