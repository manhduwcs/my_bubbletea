@extends('menu.index')

@section('main_menu')
<div class="d-block">
    <div class="left_content d-flex">
    <h2 class="text-center mb-3" style="width: 65vw;">Danh mục sản phẩm</h2>
        @foreach ($product_withfilter as $product)
            <div class="item_container">
                {{-- <a class="link_product_item" href="{{ route('show_product_item',['main_name' => $product->main_name]) }}"> --}}
                <a class="product_list_item" href="/menu/product/{{ $product->main_name }}">
                    <img class="product_items" src="{{ asset($product->image) }}" alt="">
                    <p class="product_category">{{ $product->category }}</p>
                    <p class="product_name">{{ $product->name }}</p>
                    <p class="product_price">{{ number_format($product->price,'0',',','.') }} &#8363;</p>    
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection