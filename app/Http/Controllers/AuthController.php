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
               
                return redirect('/dashboardpage');
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
    
        // Redirect to the login page with a logout message
        return redirect('/login')->with('message', 'You have been logged out successfully.');
    }
    public function admindashboard(){
        return view('admin.adminportal');
    }
}
