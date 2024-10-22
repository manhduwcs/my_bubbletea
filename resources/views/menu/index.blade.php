@extends('layouts.app')

@section('title','Menu')

@section('content')

<div class="menu_container d-flex">
    <div class="right_content">
        <div class="home_redirect_container d-flex">
            <a class="home_redirect" href="/home"><h2>Trang chủ</h2></a>   <h2 class="ms-3 me-3">/</h2>  <h2>Menu</h2>
        </div>
        <div class="menu_products_container">
            <h3 class="mt-4 mb-3">Sản phẩm</h3>
            <ul>
                <a class="product_list_item" href="/menu/bubbletea"><li class="li_product_list_item">Trà Sữa</li></a>
                <a class="product_list_item" href="/menu/fruittea"><li class="li_product_list_item">Trà Hoa Quả</li></a>
                <a class="product_list_item" href="/menu/icecream"><li class="li_product_list_item">Kem</li></a>
            </ul>
        </div>
        <div class="menu_filter_container">
            <h3 class="mt-5 mb-3">Lọc sản phẩm</h3>
            <ul>
                <a class="product_list_item" href=""><li class="li_filter_list_item">Giá : thấp - cao</li></a>
                <a class="product_list_item" href=""><li class="li_filter_list_item">Giá : cao - thấp</li></a>
                <a class="product_list_item" href=""><li class="li_filter_list_item">Mức độ phổ biến</li></a>
                <a class="product_list_item" href=""><li class="li_filter_list_item">Mới nhất</li></a>
            </ul>
        </div>
        <div class="suggest_container">
            <h2 class="mt-5 mb-3">Gợi ý cho bạn</h2>
            {{-- <div class="suggest_item_container">
                <a href="">
                    <img src="{{ $products->image }}" alt="">
                    <h3>{{ $products->name }}</h3>
                    <h3>{{ $product_sizeL }}</h3>
                </a>
            </div>
            <div class="recently_item_container">
                <a href="">
                    <img src="{{ $products->image }}" alt="">
                    <h3>{{ $products->name }}</h3>
                    <h3>{{ $product_sizeL }}</h3>
                </a>
            </div>
            <div class="recently_item_container">
                <a href="">
                    <img src="{{ $products->image }}" alt="">
                    <h3>{{ $products->name }}</h3>
                    <h3>{{ $product_sizeL }}</h3>
                </a>
            </div> --}}
        </div>
    </div>

    <div class="left_content d-flex">
        <h2 class="text-center mb-4" style="width: 65vw;">Danh mục sản phẩm</h2>
        @foreach ($products as $product)
            <div class="item_container">
                {{-- <a class="link_product_item" href="{{ route('show_product_item',['main_name' => $product->main_name]) }}"> --}}
                <a class="link_product_item" href="/menu/product/{{ $product->main_name }}">
                    <img class="product_items" src="{{ $product->image }}" alt="">
                    <p class="product_category">{{ $product->category }}</p>
                    <p class="product_name">{{ $product->name }}</p>
                    <p class="product_price">{{ $product->price }} VND</p>    
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
<style>
    .menu_container{
        width: 91vw;
        padding-top: 2vw;
        margin-left: 0px;
        margin-right: 0px;
    }
    .right_content{
        margin-left: 0px;
        position: fixed;
    }
    .home_redirect{
        color: #557c56;
        text-decoration: none;
    }
    .product_list_item{
        text-decoration: none;
        color: black; 
    }
    .link_product_item{
        text-decoration: none;
        color: black;
    }
    h2{
        white-space: nowrap;
    }
    ul{
        list-style-type: none;
        font-size: 20px;
    }
    .li_product_list_item{
        width: 210px;
        margin-bottom: 10px;
        padding-left: 4px;
        box-sizing: content-box;
        border-bottom: 3px solid rgba(0, 0, 0, 0.2);
    }
    .li_filter_list_item{
        width: 210px;
        margin-bottom: 13px;
        padding-left: 4px;
        box-sizing: content-box;
        border-bottom: 3px solid rgba(0, 0, 0, 0.2);
    }

    .left_content{
        margin-left: 320px;
        margin-right: 0px;
        flex-wrap: wrap;
    }
    .item_container{
        line-height: 1;
        margin-right: 40px;
        margin-bottom: 20px;
        max-width: 300px;
    }
    .product_items{
        width: 300px;
        height: 300px;
    }
    .product_category{
        font-size: 17px;
        margin-top: 4px;
        margin-bottom: 4px;
        text-transform: uppercase;
    }
    .product_name{
        font-size: 25px;
        margin-bottom: 4px;
    }
    .product_price{
        font-size: 25px;
        font-weight: bold;
    }
    
</style>
@endpush

@push('scripts')
    
@endpush
