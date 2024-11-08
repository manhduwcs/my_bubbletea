@extends('layouts.app')

@section('title','Confirm Your Order')

@section('content')
<div class="user_order_container w-50 mx-auto">
    <h2 class="text-center mb-3">Xác nhận đặt hàng</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <p class="order_text">Đơn đặt hàng của bạn bao gồm :</p>
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
    <p class="order_text">Vui lòng điền thông tin của bạn vào form dưới đây. Đơn hàng sẽ nhanh chóng được giao tới bạn !</p>
    
    <form action="/order/confirm" method="POST" class="form-control border-2 p-3">
        @csrf
        {{-- @if (isset($user))
            <span class="order_text">Họ và tên</span><input type="text" name="name" class="form-control border-2" required value={{ ($user->name) ?: (old('name')) }} >
            <span class="order_text">Số điện thoại :</span><input type="number" name="phone" class="form-control border-2" required value={{ ($user->phone) ?: (old('phone')) }} >
            <span class="order_text">Email (không bắt buộc) :</span><input type="email" name="email" class="form-control border-2" value={{ ($user->email) ?: (old('email')) }}>
            <span class="order_text">Địa chỉ : </span><input type="text" name="address" class="form-control border-2" required value={{ ($user->address) ?: (old('address')) }} >
        @else --}}
            <span class="order_text">Họ và tên</span><input type="text" name="name" class="form-control border-2" required value={{ old('name') }}>
            <span class="order_text">Số điện thoại :</span><input type="number" name="phone" class="form-control border-2" required value={{ old('phone') }} >
            <span class="order_text">Email (không bắt buộc) :</span><input type="email" name="email" class="form-control border-2" value={{ old('email') }}>
            <span class="order_text">Địa chỉ : </span><input type="text" name="address" class="form-control border-2" required value={{ old('address') }} >
        {{-- @endif --}}
        <button type="submit" class="btn btn-primary mt-3">Xác nhận đặt hàng</button>
    </form>
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
</style>
@endpush