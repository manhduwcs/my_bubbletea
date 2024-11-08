@extends('layouts.app')

@section('title','Order Invoice')


@section('content')
<div class="invoice_container w-50 mx-auto">
    <h2 class="text-center mb-3">Đơn hàng của bạn đã được đặt thành công !</h2>
    <p class="order_text mb-0">Khách hàng : {{ $current_user->get('name') }} | SDT : {{ $current_user->get('phone') }}</p>
    <p class="order_text">Địa chỉ : {{ $current_user->get('address') }}</p>
    @if ($current_user->get('guest')!==null)
        <p>Thông báo : Tài khoản của bạn hiện đang là tài khoản khách. Vui lòng <a class="register_link" href="/register">đăng ký tài khoản</a> để trở thành người dùng chính thức và sử dụng những dịch vụ khác của chúng tôi !</p>
    @endif
    <p class="order_text">Đơn hàng sẽ được chuyển giao tới đơn vị vận chuyển và chuyển giao cho bạn trong thời gian ngắn nhất.</p>
    <p class="order_text">Bạn có thể theo dõi đơn hàng của mình ở mục Đơn hàng của bạn.</p>
    <p class="order_text" style="font-weight: bold;">Đơn đặt hàng của bạn bao gồm :</p>
    <div class="mb-3">
        @foreach ($selectedProducts as $item)
        <div class="d-flex">
            <img class="order_img" src="{{ asset($item->image) }}" alt="">
            <div class="d-block ms-4">
                <h4>{{ $item->name }}</h4>
                <h5>Size {{ $item->size }} - {{ $item->quantity }} cốc</h5>    
                @php
                    $total_price = 0;
                    if (isset($quantity)) {
                        $total_price = $item->price * $quantity;
                    } else if(isset($item->quantity)) {
                        $total_price = $item->price * $item->quantity;
                    }
                @endphp
                <h5>Thành tiền : {{ number_format($total_price,0,',','.') }} &#8363;</h5>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
<style>
    .order_img{
        width: 100px;
        height: 100px;
    }
    .order_text{
        font-size: 22px;
        margin-bottom: 20px;
    }
    .register_link{
        text-decoration: none;
    }
</style>
@endpush