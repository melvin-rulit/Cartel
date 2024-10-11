<?php

namespace app\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\View\Factory;

class LoginController extends Controller
{
    public function login(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('auth.login');
    }
}
