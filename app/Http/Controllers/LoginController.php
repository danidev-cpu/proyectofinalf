<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function signupForm(): View{
        return view('auth.signup');
    }


    public function signup(SignupRequest $request): RedirectResponse{
        $user = new User();
        $user->username = $request->get('username');
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        Auth::login($user);

        return redirect()->route('users.account');
    }


    public function loginForm(): View|RedirectResponse{
        if(Auth::viaRemember()){
            return redirect()->route('users.account');
        }else if (Auth::check()){
            return redirect()->route('users.account');
        }else{
            return view('auth.login');
        }
    }

    public function login(Request $request): RedirectResponse{
        $credentials = $request->only('username', 'password');

        if(Auth::guard('web')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('users.account');
        } else {
            return back()->withErrors(['username' => 'Credenciales incorrectas.']);
        }
    }

    public function logout(Request $request): RedirectResponse{
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }

    public function account(): View
    {

        $user = Auth::user();
        return view('auth.account', compact('user'));
    }

    public function destroy(Request $request): RedirectResponse
{
    $user = Auth::user();

    Auth::logout();


    


    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('home')->with('success', 'Tu cuenta ha sido eliminada correctamente.');
}

}
