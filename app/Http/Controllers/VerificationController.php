<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class VerificationController extends Controller
{
    public function show_register_verify(){
        return view('verify.registerVerify');
    }

    public function show_user_edit_verify(){
        return view('verify.userEditVerify');
    }

    public function show_forgetpass_verify(){
        $name = Auth::user()->name;
        return view('verify.userForgetpassVerify',compact('name'));
    }

    public function make_newpass(){
        $name = Auth::user()->name;
        return view('auth.newPass',compact('name'));
    }

    public function show_loginforget_verify(){
        $name = Session::get('name');
        return view('verify.loginForget',compact('name'));
    }

    public function make_loginforget_newpass(){
        $name = Session::get('name');
        return view('auth.loginForgetNewPass',compact('name'));
    }

    public function confirm_loginforget_newpass(Request $request){
        $request->validate([
            'password' => 'required|regex:/^\S{6,20}$/',
            'password_confirm' => 'required|regex:/^\S{6,20}$/', 
        ]);

        $email = Session::get('email');
        $phone = Session::get('phone');

        $user = DB::table('users')
            ->where('email',$email)
            ->where('phone',$phone)
            ->first();

        if($request->password != $request->password_confirm){
            return back()->withErrors(['error'=>'Password do not match. Try again !']);
        }

        if(Hash::check($request->password,$user->password)){
            return back()->withErrors(['error'=>'New password must be different from current password !']);
        }

        $password = Hash::make($request->password);
        DB::table('users')
            ->where('id',$user->id)
            ->update(['password'=>$password]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Session::put('success','New password has been made succesfully. Please log in again.');
        return redirect()->route('login');
    }

    public function show_loginforget_newpass(Request $request){
        $code = Session::get('code');
        $created_at = Session::get('code_created_at');

        if($code != $request->input_code){
            return back()->withErrors(['error'=>'You have entered the wrong code !']);
        }
        
        if(now()->diffInMinutes($created_at,true) > 3){
            Session::forget([
                'code',
                'code_created_at',
            ]);
            return redirect()->route('show_current_user')->withErrors(['error'=>'Your expiration request has expired. Please try again !']);
        }

        Session::forget('code','code_created_at');
        return redirect()->route('make_loginforget_newpass');
    }

    public function confirm_newpass(Request $request){
        $request->validate([
            'password' => 'required|regex:/^\S{6,20}$/',
            'password_confirm' => 'required|regex:/^\S{6,20}$/', 
        ]);

        $user = Auth::user();

        if($request->password != $request->password_confirm){
            return back()->withErrors(['error'=>'Password do not match. Try again !']);
        }

        if(Hash::check($request->password,$user->password)){
            return back()->withErrors(['error'=>'New password must be different from current password !']);
        }

        $password = Hash::make($request->password);
        DB::table('users')
            ->where('id',$user->id)
            ->update(['password'=>$password]);

        Auth::logout($user);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Session::put('success','New password has been made succesfully. Please log in again.');
        return redirect()->route('login');
    }

    public function show_newpass(Request $request){
        $code = Session::get('code');
        $created_at = Session::get('code_created_at');

        if($code != $request->input_code){
            return back()->withErrors(['error'=>'You have entered the wrong code !']);
        }
        
        if(now()->diffInMinutes($created_at,true) > 3){
            Session::forget([
                'code',
                'code_created_at',
            ]);
            return redirect()->route('show_current_user')->withErrors(['error'=>'Your expiration request has expired. Please try again !']);
        }

        $name = Auth::user()->name;
        Session::forget(['code','code_created_at']);
        return redirect()->route('make_newpass');
    }

    public function confirm_user_edit(Request $request){
        $code = Session::get('code');
        $created_at = Session::get('code_created_at');

        if($code != $request->input_code){
            return back()->withErrors(['error'=>'You have entered the wrong code !']);
        }
        
        if(now()->diffInMinutes($created_at,true) > 3){
            Session::forget([
                'code',
                'code_created_at',
                'name',
                'email',
                'phone',
                'address'
            ]);
            return redirect()->route('show_current_user')->withErrors(['error'=>'Your expiration request has expired. Please try again !']);
        }

        $user = Auth::user();

        $name = Session::get('name');
        $phone = Session::get('phone');
        $email = Session::get('email');
        $address = Session::get('address');
        
        if($name != $user->name){
            $user->name = $name;
            $user->save();
        }

        if($address != $user->address){
            $user->address = $address;
            $user->save();
        }

        if($email != $user->email){
            $user->email = $email;
            $user->save();
        }

        if($phone != $user->phone){
            $user->phone = $phone;
            $user->save();
        }

        Auth::logout($user);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        Session::put('success','Your information has been changed succesfully. Please log in again !');
        return redirect()->route('login');
    }

    public function confirm_register(Request $request){
        $code = Session::get('code');
        $created_at = Session::get('code_created_at');

        if($code != $request->input_code){
            return back()->withErrors(['error'=>'You have entered the wrong code !']);
        }
        
        if(now()->diffInMinutes($created_at,true) > 3){
            Session::forget([
                'code',
                'code_created_at',
                'name',
                'email',
                'phone',
                'password',
                'address'
            ]);
            return redirect()->route('register')->withErrors(['error'=>'Your expiration request has expired. Please try again !']);
        }
        
        $name = Session::get('name');
        $phone = Session::get('phone');
        $email = Session::get('email');
        $password = Session::get('password');
        $address = Session::get('address');
        
        $user = User::create([
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'password' => $password,
            'address' => $address,
            'account_status' => 'Active'
        ]);

        Auth::login($user);

        Session::forget([
            'code',
            'code_created_at',
            'name',
            'email',
            'phone',
            'password',
            'address'
        ]);

        return redirect()->route('home');
    }
}
