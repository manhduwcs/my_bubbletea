<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\BubbleMail;
use Illuminate\Console\View\Components\BulletList;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function show_login(){
        
        return view('auth.login');
    }

    public function show_register(){
        return view('auth.register');
    }

    public function show_edit_user(){
        $user = Auth::user();
        if($user->id == 21){
            $badge = 'AduProVip Member';
        }
        else{
            $quantity = DB::table('orders')
                ->where('user_id',$user->id)
                ->where('status','Completed')
                ->sum('quantity');

            if($quantity >= 30){
                $badge = 'AduProVip Member';
            }
            if($quantity >= 10){
                $badge = 'Platinum Member';
            }
            if($quantity >= 5){
                $badge = 'Silver Member';
            }
            if($quantity < 5){
                $badge = 'Fresh Member';
            }
        }
        return view('user.editUser',compact('user','badge'));
    }

    public function show_user_changepass(){
        $name = Auth::user()->name;
        return view('auth.changePass',compact('name'));
    }

    public function show_user_forgetpass(){
        $name = Auth::user()->name;
        return view('auth.forgetPass',compact('name'));
    }

    public function show_login_forgetpass(){
        return view('auth.loginForgetPass');
    }

    public function send_loginforget_mail(Request $request){
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|regex:/^0[0-9]{9}$/',      
        ]);

        $user = DB::table('users')
            ->where('email',$request->email)
            ->where('phone',$request->phone)
            ->first();

        if(!isset($user)){
            return back()->withErrors(['error'=>'Cannot find your account. Please check and re-enter your email and phone number.']);
        }

        Mail::to($user->email)->send(new BubbleMail($user->email,$user->name,'Your Bubble Tea - Forgot Password Confirmation Code'));
        Session::put([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
        ]);
        return redirect()->route('show_loginforget_verify');
    }

    public function show_current_user(){
        $user = Auth::user();
        $badge = '';
        if($user->id == 21){
            $badge = 'AduProVip Member';
        }
        else{
            $quantity = DB::table('orders')
                ->where('user_id',$user->id)
                ->where('status','Completed')
                ->sum('quantity');

            if($quantity >= 30){
                $badge = 'AduProVip Member';
            }
            if($quantity >= 10){
                $badge = 'Platinum Member';
            }
            if($quantity >= 5){
                $badge = 'Silver Member';
            }
            if($quantity < 5){
                $badge = 'Fresh Member';
            }
        }
        return view('user.index',compact('user','badge'));
    }

    public function send_forgetpass_mail(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = Auth::user();
        if($request->email != $user->email){
            return redirect()->route('show_user_forgetpass')->withErrors(['error'=>'This is not your current email ! Please try again.']);
        }

        Mail::to($user->email)->send(new BubbleMail($user->email,$user->name,'Your Bubble Tea - Forget Password Code Confirmation'));
        return redirect()->route('show_forgetpass_verify');
    }
    
    public function change_user_pass(Request $request){
        $request->validate([
            'password' => 'required|regex:/^\S{6,20}$/',
            'password_new' => 'required|regex:/^\S{6,20}$/', 
        ]);

        $user = Auth::user();
        if(!Hash::check($request->password,$user->password)){
            return back()->withErrors(['error'=>'You have entered wrong current password !']);
        }

        if($request->password == $request->password_new){
            return back()->withErrors(['error'=>'New password must be different from current password !']);
        }

        $user->password = Hash::make($request->password_new);
        $user->save();

        Auth::logout($user);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        Session::put('success','Your password has been changed succesfully. Please login again !');
        return redirect()->route('login');
    }

    public function edit_current_user(Request $request){
        $user = Auth::user();
        if($request->name == $user->name && $request->email == $user->email && $request->phone == $user->phone && $request
        ->address == $user->address){
            return back()->withErrors(['error' => 'No changes were made !']);
        }

        $request->validate([
            'name' => 'required|string|min:5|max:40|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email',
            'phone' => 'required|regex:/^0[0-9]{9}$/',      
            'address' => 'max:300|regex:/^[a-zA-Z0-9\s\.,-]*$/'
        ]);
        
        if($request->email != $user->email || $request->phone != $user->phone){
            Session::put([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address'=> $request->address
            ]);
            Mail::to($request->email)->send(new BubbleMail($request->email,$request->name,'Your Bubbletea - Change Profile Confirmation Code'));
            return redirect()->route('show_user_edit_verify');
        }

        if($request->name != $user->name){
            $user->name = $request->name;
            $user->save();
        }

        if($request->address != $user->address){
            $user->address = $request->address;
            $user->save();
        }

        Session::put('success','Your information has been changed succesfully');
        return redirect()->route('show_current_user');

    }

    public function check_register(Request $request){
        $request->validate([
            'name' => 'required|string|min:5|max:40|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email',
            'phone' => 'required|regex:/^0[0-9]{9}$/',
            'password' => 'required|regex:/^\S{6,20}$/',
            'address' => 'max:300|regex:/^[a-zA-Z0-9\s\.,-]*$/'
        ]);

        if(Auth::check()){
            return back()->withErrors(['error'=>'You have already logged in.']);
        }

        $user_email = DB::table('users')->where('email',$request->email)->first();
        $user_phone = DB::table('users')->where('phone',$request->phone)->first();
        if(isset($user_email) || isset($user_phone)){
            return back()->withErrors(['error'=>'Email or Phone number already exists !']);
        }

        if($request->password != $request->password_confirm){
            return back()->withErrors(['error'=>'Password do not match. Try again !']);
        }

        Session::put([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'address'=> $request->address
        ]);

        Mail::to($request->email)->send(new BubbleMail($request->email,$request->name,'Your Bubbletea - Register Confirmation Code'));
        
        return redirect()->route('show_register_verify');
    }

    public function confirm_login(Request $request){
        Session::forget('success');
        $login_var = $request->login_var;
        $password = $request->password;

        $login_check = filter_var($login_var,FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if($login_check=='email'){
            $email = $login_var;
            $validator = Validator::make([
                    'email' => $email,
                    'password' => $password,
                ], 
                
                [
                    'email' => 'required|email',
                    'password' => 'required|regex:/^\S{6,20}$/',
                ]
            );
            if($validator->fails()){
                dd($validator);
                return back()->withErrors(['error'=>'Wrong input type. Please try again !']);
            }

            $credentials = [
                'email' => $email,
                'password' => $password
            ];

            if(Auth::attempt($credentials)){
                return redirect()->route('home');
            }
            return back()->withErrors(['error' => 'Incorrect phone number, email or password. Please try again !']);
        }

        if($login_check=='phone'){
            $phone = $login_var;
            $validator = Validator::make([
                    'phone' => $phone,
                    'password' => $password
                ],
                [
                    'phone' => 'required|regex:/^0[0-9]{9}$/',
                    'password' => 'required|regex:/^\S{6,20}$/',
                ]
            );
            if($validator->fails()){
                return back()->withErrors(['error'=>'Wrong input type. Please try again !']);
            }

            $credentials = [
                'phone' => $phone,
                'password' => $password
            ];
            if(Auth::attempt($credentials)){
                return redirect()->route('home');
            }
            return back()->withErrors(['error' => 'Incorrect phone number, email or password. Please try again !']);
        }
    }

    public function logout(Request $request){
        if(!Auth::check()){
            return redirect()->route('login')->withErrors(['error'=>'You are not logged in !']);
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
    
}
