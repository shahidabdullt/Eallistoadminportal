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
            $user = Auth::user();
            //  dd($user->isadmin);
            // $token = $user->createToken('MyApp')->accessToken;
            if ($user->isadmin=="1") {
                // $token = $user->createToken('AdminApp')->accessToken;
                // $request->session()->put('token', $token);
                return redirect('/admin/dashboardpage');
            } else {
                $token = $user->createToken('UserApp')->accessToken;
                $request->session()->put('token', $token);
                return redirect('/dashboardpage')->with('token', $token);
            }
           
        }

       

        return back()->withErrors(['Username' => 'Invalid Credentials'])->withInput();
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
