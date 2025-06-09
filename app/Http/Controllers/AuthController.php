<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        // event(new Registered($user));
        return view('login');
    }


    public function Authentication(Request $request)
    {
         
        $credentials = $request->validate([
            'Username' => 'required',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($credentials)) {
             $request->session()->regenerate(); 
            $user = Auth::user();
            
            if ($user->isadmin=="1") {
                
                return redirect('/admin/dashboardpage');
            } else {
               
                return redirect('/login')->withErrors('you do not have admin access');
            }
           
        }

       

        return back()->withErrors([
            'Username' => 'Invalid credentials',
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request){
        Auth::logout();

        // Invalidate the user's session
        $request->session()->invalidate();
    
        // Regenerate CSRF token to avoid session fixation
        $request->session()->regenerateToken();
        return redirect('/login');
    
    }
    public function admindashboard(){ 
        return view('admin.adminportal');
    }
}
