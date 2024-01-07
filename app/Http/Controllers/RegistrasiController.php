<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrasiController extends Controller
{
    public function showRegisterForm()
    {
        return view('backend.component.register');
    }

    public function prosesRegister(Request $request)
    {
        $register = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role_id' => '64420065-cb52-4778-9391-f3016ae61751'
        ]);

        if ($register) {
            return redirect('/');
        } else {
            return redirect('/register');
        }
    }
}
