<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function show_menu(){
        $products = DB::table('products')->get();
        
        $products = $products->groupBy('main_name')->map(function ($product) {
            return $product->firstWhere('size', 'L') ?: $product->first();
        })->values();

        $suggest_products = $products->shuffle()->random(3);
        $product_category = $products->unique('main_category')->values();
        
        return view('menu.main_menu',compact('products','suggest_products','product_category'));
        
    }

    public function show_category_list($main_category){
        $products = DB::table('products')->get();
        $products = $products->groupBy('main_name')->map(function ($product) {
            return $product->firstWhere('size', 'L') ?: $product->first();
        })->values();
        
        $product_customCategory = $products->filter(function($product) use($main_category){
            return $product->main_category === $main_category;
        })->values();
        
        $category_name = $product_customCategory->first()->category;
        
        $suggest_products = $products->shuffle()->random(3);
        $product_category = $products->unique('main_category')->values();
        return view('menu.category',compact('products','product_customCategory','suggest_products','product_category','category_name'));
    }

    public function show_product_item($main_name){
        $products = DB::table('products')
            ->where('main_name',$main_name)
            ->get();
            
        $suggest_products = DB::table('products')
            ->where('main_name','!=',$main_name)
            ->where('size','L')
            ->inRandomOrder()
            ->take(4)
            ->get();
        return view('menu.product_item',compact('products','suggest_products'));
    }

    public function show_product_item_with_filter($condition){
        $products = DB::table('products')
            ->where('size','L')
            ->get();

        if($condition=="min_price_first"){
            $product_withfilter = $products->sortBy('price')->values();
        }
        else if($condition=="max_price_first"){
            $product_withfilter = $products->sortByDesc('price')->values();
        }
        else if($condition=="by_popular"){
            $product_withfilter = $products->sortByDesc('popular')->values();
        }
        else if($condition=="by_latest"){
            $product_withfilter = $products->sortByDesc('created_at')->values();
        }

        $suggest_products = $products->shuffle()->random(3);
        $product_category = $products->unique('main_category')->values();
        return view('menu.filter',compact('products','product_withfilter','suggest_products','product_category'));
    }

}
