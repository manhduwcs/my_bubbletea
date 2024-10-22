<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function show_menu(){
        $products = DB::table('products')
            ->where('size','L')
            ->get();

        return view('menu.index',compact('products'));
    }

    public function show_category_list(Request $request){
        // Query category va truy xuat, tra ve $result vao view menu.category

        return view('menu.category');
    }

    public function show_product_item($main_name){
        $product = DB::table('products')
            ->where('main_name',$main_name)
            ->get();
        $suggest_product = DB::table('products')
            ->where('main_name','!=',$main_name)
            ->where('size','L')
            ->inRandomOrder()
            ->take(4)
            ->get();
        return view('menu.product_item',compact('product','suggest_product'));
    }


}
