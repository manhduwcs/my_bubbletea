@extends('layouts.app')

@php
    $image = $products[0]->image;
    $name = $products[0]->name;
@endphp

@section('title',$name)

@section('content')
    <div class="product_item_container d-flex">
        <div class="image_container">
            <img class="product_item_image" src="{{ asset($image) }}" alt="">
        </div>

        <div class="infor_container">
            <div class="d-flex">            
                <a class="home_redirect" href="/home"><h4 style="font-size: 27px; opacity: 0.9">Trang chủ</h4></a>   
                <h4 style="color: #557c56; font-size: 27px; opacity: 0.9" class="ms-3 me-3">/</h4>
                <a class="menu_redirect" href="/menu"><h4 style="font-size: 27px; opacity: 0.9;">Menu</h4></a>
            </div>
            <a style="color: #54473f; opacity: 0.9;" href="/menu/category/{{ $products[0]->main_category }}">
                <h3 class="item_category">{{ $products[0]->category }}</h3>
            </a>
            <div class="item_seperate"></div>
            <h3 class="item_name mt-4 mb-4">{{ $products[0]->name }}</h3>
            <div class="item_size_container mt-4" id="item_size_container">
                @foreach ($products as $item)
                    <button class="item_size_button">
                        {{ $item->size }}
                    </button>  
                @endforeach
            </div>
            <div class="mt-3">
                @foreach ($products as $item)
                    <h4 class="item_price_tag">
                        {{ number_format($item->price,0,',','.') }} &#8363;
                        <input type="hidden" class="input_item_price" value="{{ $item->price }}">
                    </h4>
                @endforeach
            </div>

            <div class="item_seperate mb-5"></div>

            <div class="d-flex">
                <form action="" method="">
                    <button type="button" id="decrease_quantity_button">-</button>
                    <input type="number" name="choose_quantity" id="choose_quantity" value="1" min="1" max="20" readonly>
                    <button type="button" id="increase_quantity_button">+</button>
                </form>
                <button class="add_to_cart_button ms-3"><i class="bi bi-cart"></i></button>
            </div>
            <button class="order_item_button mt-3">Đặt hàng ngay !!!</button>
        </div>
    </div>
    <div class="more_info_container mt-5">
        <h4 style="font-size: 27px; opacity: 0.9; color:#54473f">Thông tin bổ sung</h4>
        <div class="item_seperate"></div>
        <div class="fullscreen_seperate"></div>
        <p class="item_description mt-3">{{ $products[0]->description }}</p>
        <p class="item_description mt-3">Tên sản phẩm : {{ $name }}</p>
        <p class="item_description mt-3">Các size hiện có của sản phẩm : @foreach ($products as $item)
            <span>{{ $item->size }}</span>
        @endforeach</p>
        <p class="item_description mt-3">Sản phẩm này là {{ $products[0]->category }}</p>
        <p class="item_description mt-3">Lượng đường : 30% | 50% | 100%</p>
    </div>
    <div class="suggest_item_container mt-5A">
        <h4 style="font-size: 27px; opacity: 0.9; color:#54473f">Sản phẩm tương tự</h4>
        <div class="item_seperate mb-3"></div>
        <div class="suggest_item d-flex">
            @foreach ($suggest_products as $item)
            @php
                $image = $item->image;
            @endphp            
                <div style="margin-right: 30px;" class="d-block">
                    <a href="/menu/product/{{ $item->main_name }}">
                        <img class="suggest_item_image" src="{{ asset($image) }}" alt="">                
                    </a>
                    <a href="/menu/category/{{ $item->main_category }}">
                        <p class="suggest_item_category">{{ $item->category }}</p>
                    </a>
                    <a href="/menu/product/{{ $item->main_name }}">
                        <p class="suggest_item_name">{{ $item->name }}</p>
                        <h4 class="suggest_item_price">{{ number_format($item->price,0,',','.') }} &#8363;</h4>        
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('styles')
<style>
    .product_item_container{
        padding-top: 30px;
        padding-top: 30px;
    }
    .infor_container{
        margin-left: 40px;
    }
    .home_redirect,.menu_redirect{
        font-size: 20px;
    }
    .product_item_image{
        width: 530px;
        height: 530px;
    }
    .item_price_tag{
        display: none;
        font-size: 37px;
        color: #54473f;
    }
    a{
        text-decoration: none;
        color: #557c56; 
    }
    .item_category{
        font-size: 20px;
        text-transform: uppercase;
    }
    .item_name{
        font-size: 40px;
        color: #54473f;
    }
    .item_size_button{
        width: 60px;
        height: 35px;
        margin-right: 5px;
        background-color: #557c56;
        color: white;
        font-weight: bold;
        border-radius: 5px;
        font-size: 20px;
        border: none;
    }
    .item_size_button.click{
        width: 65px;
        height: 40px;
        background-color: #185519;
        color: #fff;
        font-weight: bold;
        border-radius: 5px;
        font-size: 22px;
        border: none;
    }
    .item_seperate{
        width: 100px;
        height: 4px;
        background-color: #54473f;
    }
    #decrease_quantity_button,#increase_quantity_button{
        width: 50px;
        height: 50px;
        background-color: #557c56;
        border: none;
        color: #fff;
        font-size: 20px;
        font-weight: bold;
    }
    #decrease_quantity_button.click,#increase_quantity_button.click{
        width: 50px;
        height: 50px;
        background-color: #185519;
        border: none;
        color: #fff;
        font-size: 20px;
        font-weight: bold;
    }

    #choose_quantity{
        width: 80px;
        height: 50px;
        text-align: center;
        box-sizing: border-box;
        padding-left: 15px;
        font-size: 20px;
        font-weight: bold;
    }
    .add_to_cart_button{
        width: 50px;
        height: 50px;
        border: 2px solid #54473f;
        background-color: #e7cccc;
        color: #54473f;
        font-size: 30px;
    }
    .order_item_button{
        width: 254px;
        height: 50px;
        border: 2px solid #54473f;
        background-color: #e7cccc;
        color: #54473f;
        font-size: 20px;
        font-weight: bold;
    }
    .fullscreen_seperate{
        border: 1px solid #D1D5DB; 
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Tạo hiệu ứng bóng mờ nhẹ */
    }
    .item_description{
        font-size: 22px;
        color: #54473f;
        line-height: 1.7;
    }
    .suggest_item{
        max-width: 310px;
    }
    .suggest_item_image{
        width: 310px;
        height: 310px;
    }
    .suggest_item_category{
        font-size: 18px;
        color:#185519;
        text-transform: uppercase;
    }
    .suggest_item_name{
        margin-top: -15px;
        font-size: 22px;   
        color:#54473f;
    }
    .suggest_item_price{
        margin-top: -15px;
        color:#54473f;
    }
    
</style>
@endpush

@push('scripts')
<script src="{{ asset('js/product_item.js') }}"></script>
@endpush
