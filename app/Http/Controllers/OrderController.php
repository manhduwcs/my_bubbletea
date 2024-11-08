<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    
    public function show_order_invoice(){
        $selectedProducts = Session::get('selectedProducts',collect());
        $current_user = Session::get('current_user',collect());
        return view('order.orderInvoice',compact('selectedProducts','current_user'));
    }

    public function show_confirm_order(){
        $selectedProducts = Session::get('selectedProducts',collect());
        return view('order.confirmOrder',compact('selectedProducts'));
    }

    public function handle_order(Request $request){
        $action = htmlspecialchars($request->action, ENT_QUOTES, 'UTF-8');
        $customProducts = $request->customProducts;
        
        $selectedProducts = collect();
        foreach($customProducts as $item){
            $product = DB::table('products')
                ->where('main_name', $item['main_name'])
                ->where('size',$item['size'])
                ->where('price',$item['price'])
                ->first();
            if(isset($product)){
                $selectedProducts->push($product);
            }
            else{
                return back()->withErrors(['error'=>'Unexpected error. Please try again !']);
            }
        }

        $selectedProducts->map(function($product) use($customProducts){
            foreach($customProducts as $item){
                $quantity = $item['quantity'];
                $product->quantity = $quantity;
                return $product;
            }
        });

        if(isset($selectedProducts)){
            if($action=="add_to_cart"){
                if(!Auth::check()){
                    return back()->withErrors(['error'=>'You must log in first to use this feature. Log in to continue shopping !']);
                }  

                $user_id = Auth::user()->id;
                if(!isset($user_id)){
                    return back()->withErrors(['error'=>'Unexpected error, please try logout and login again.']);
                }

                foreach($selectedProducts as $product){
                    Order::create([
                        'user_id' => $user_id,
                        'product_id' => $product->id,
                        'quantity' => $product->quantity,
                        'status' => 'InCart'
                    ]);
                }  
                return back()->with('success', 'Products added to cart successfully!');
            }
            
            else if($action=="place_order"){
                Session::put('selectedProducts',$selectedProducts);
                
                if(!Auth::check()){
                   return redirect()->route('show_confirm_order');
                }
                else{
                    $user = Auth::user();
                    return redirect()->route('show_confirm_order');
                }
            }
        }          
    }

    public function confirm_order(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|size:10|regex:/^0[0-9]{9}$/',
            'address' => 'required|string|max:500',
        ]);

        $name =  htmlspecialchars($request->name, ENT_QUOTES, 'UTF-8');
        $email =  htmlspecialchars($request->email, ENT_QUOTES, 'UTF-8');
        $phone =  htmlspecialchars($request->phone, ENT_QUOTES, 'UTF-8');
        $address =  htmlspecialchars($request->address, ENT_QUOTES, 'UTF-8');

      
        if(!Auth::check()){
            $users = DB::table('users')->get();
            
            if(!isset($users)) {
                return back()->withErrors(['error'=>'Empty User']);
            }
            
            foreach($users as $user){  
                if($email == $user->email || $phone == $user->phone){
                    if($name != $user->name || $address != $user->address){
                        return back()->withErrors(['error'=>'Số điện thoại / Email đã tồn tại !']);
                    }
                }

                if($name == $user->name && $email == $user->email && $phone == $user->phone && $address == $user->address){
                    $selectedProducts = Session::get('selectedProducts',collect());
                    
                    foreach($selectedProducts as $product){ 
                        Order::create([
                            'user_id' => $user->id,
                            'product_id' => $product->id,
                            'quantity'=> $product->quantity,
                            'status' => 'Ordered'
                        ]);
                    }

                    $current_user = [
                        'name' => $user->name,
                        'phone' => $user->phone,
                        'address' => $user->address,
                        'guest' => 'yes'
                    ];
                    $current_user = collect($current_user);
                    Session::put('current_user',$current_user);
                    return redirect()->route('order_invoice');
                }
            }
        
            $guest = User::create([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'account_status' => 'Guest',
                'password' => '',
            ]);    
            
            $selectedProducts = Session::get('selectedProducts',collect());

            foreach($selectedProducts as $product){
                Order::create([
                    'user_id' => $guest->id,
                    'product_id' => $product->id,
                    'quantity' => $product->quantity,
                    'status' => 'Ordered'
                ]);
            }

            $current_user = [
                'name' => $guest->name,
                'phone' => $guest->phone,
                'address' => $guest->address,
                'guest' => 'yes',
            ];
            $current_user = collect($current_user);
            Session::put('current_user',$current_user);
            return redirect()->route('order_invoice');
        }

        else{
            $user = Auth::user();
            $selectedProducts = Session::get('selectedProducts',collect());
            foreach($selectedProducts as $product){
                Order::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $product->quantity,
                    'status' => 'Ordered'
                ]);
            }
            $current_user = [
                'name' => $user->name,
                'phone' => $user->phone,
                'address' => $user->address,
                
            ];
            $current_user = collect($current_user);
            Session::put('current_user',$current_user);
            return redirect()->route('order_invoice');
        } 
    }
}
