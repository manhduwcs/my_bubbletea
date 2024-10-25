@extends('layouts.app')

@section('title','Menu')

@section('content')

<div class="menu_container d-flex">
    <div class="right_content">
        <div class="home_redirect_container d-flex">
            <a class="home_redirect" href="/home"><h2>Trang chủ</h2></a>   <h2 class="ms-3 me-3">/</h2>  <h2>Menu</h2>
        </div>
        <div class="menu_products_container">
            <h3 class="mt-4">Sản phẩm</h3>
            <div class="item_seperate mb-3"></div>
            <ul>
                <a class="product_list_item d-block" href="/menu"><li class="li_filter_list_item">Tất cả sản phẩm</li></a>
                @foreach ($product_category as $item)
                    <a class="product_list_item d-block" href="/menu/category/{{ $item->main_category }}"><li class="li_filter_list_item">{{ $item->category }}</li></a>
                @endforeach
            </ul>
        </div>
        <div class="menu_filter_container">
            <h3 class="mt-5">Lọc sản phẩm</h3>
            <div class="item_seperate mb-3"></div>
            <ul>
                <a class="product_list_item" href="/menu/filter/min_price_first"><li class="li_filter_list_item">Giá : thấp - cao</li></a>
                <a class="product_list_item" href="/menu/filter/max_price_first"><li class="li_filter_list_item">Giá : cao - thấp</li></a>
                <a class="product_list_item" href="/menu/filter/by_popular"><li class="li_filter_list_item">Mức độ phổ biến</li></a>
                <a class="product_list_item" href="/menu/filter/by_latest"><li class="li_filter_list_item">Mới nhất</li></a>
            </ul>
        </div>
        <div class="suggest_container">
            <h2 class="mt-5">Gợi ý cho bạn</h2>
            <div class="item_seperate mb-3"></div>
            @foreach ($suggest_products as $item)
                <div class="mb-2">
                    <a class="product_list_item d-flex" href="/menu/product/{{ $item->main_name }}">
                        <img class="suggest_image" src="{{ asset($item->image) }}" alt="">
                        <div class="ms-2" style="width: 170px; height: 90px;">
                        <p style="margin-top: -5px;" class="suggest_name">{{ $item->name }}</p>
                        <h4 style="margin-top: -15px;" class="suggest_price">{{ number_format($item->price,'0',',','.') }}</h4>        
                    </div>    
                    </a>       
                </div>           
                <div class="fullscreen_seperate mb-3 mt-2"></div>              
            @endforeach
        </div>
    </div>

    {{-- yield product list for Filter Category + Filters  --}}
    @yield('main_menu')
    
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
        margin-left: -20px;
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
        margin-top: 0px;
        margin-left: 40px;
        margin-right: 0px;
        flex-wrap: wrap;
    }
    .item_container{
        margin-top: 0px;
        line-height: 1;
        margin-right: 40px;
        margin-bottom: 20px;
        max-width: 300px;
        max-height: 450px;
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
    .suggest_image{
        width: 80px;
        height: 80px;
    }
    .suggest_name{
        font-size: 20px;
    }
    .suggest_price{
        font-size: 23px;
    }
    .item_seperate{
        width: 100px;
        height: 4px;
        background-color: #54473f;
    }
    .fullscreen_seperate{
        border: 1px solid #D1D5DB; 
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Tạo hiệu ứng bóng mờ nhẹ */
    }
</style>
@endpush

@push('scripts')
    
@endpush
