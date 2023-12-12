<?php

namespace App\Http\Controllers;

use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function show(){
        return view('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.show')
            ->withSuccess('You have logged out successfully!');;
    }

    public function authenticate(Request $request)
    {
        $service = new BaseService($request->all());
        $service->rules = [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
        $service->ruleMessages = [
            'email.required' => 'email is required',
            'email.email' => 'must formated email',
            'password.required' => 'password is required',
            'password.min' => 'password min 8 character',
        ];
        $service->run();

        if($service->isError()){
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors([$service->errorMessage]);
        }

        $credentials = $request->only("email", "password");

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return redirect()->back()
            ->withInput($request->input())
            ->withErrors(["email or password not match"]);
    }
}
