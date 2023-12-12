<?php

namespace App\Http\Controllers;
use App\Services\Register\CreateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function show(){
        return view('register');
    }

    public function create(Request $request)
    {
        $service = new CreateService($request->all());
        $service->run();

        if ($service->isError()){
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors([$service->errorMessage]);
        }

        Auth::attempt($service->data);
        $request->session()->regenerate();
        return redirect()->route('dashboard')
            ->withSuccess('You have successfully registered & logged in!');
    }
}
