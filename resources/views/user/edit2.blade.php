@extends('layouts.app')

@section('content')
    <div class="user_container mx-auto">
        <div class="d-flex ms-4 mt-4">
            <img class="avatar" src="{{ asset($user->avatar) }}" alt="User Image">
            <div class="d-block ms-5 mt-3">
                <h2>{{ $user->name }}</h2>
                <h4>Gold Member</h4>
            </div>
        </div>

        <div class="mt-3">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            @php
                $success = Session::get('success');
            @endphp
            @if (isset($success))
                <div id="alert_success" class="alert alert-success alert-dismissable fade show" role="alert">
                    {{ $success }}
                </div>
            @endif
        </div>

        <div style="width: 90%;" class="d-flex mx-auto mt-5 justify-content-between" id="buttons_container">
            <a href="{{ route('show_current_user') }}"><button class="buttons">User Information</button></a>
            <button class="buttons active">Edit Profile</button>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="buttons">Log Out</button>
            </form>
        </div>

        <div id="edit_profile_container">
            <form action="{{ route('edit_current_user') }}" method="POST">
                @csrf
                <table class="table table-hover mt-2 mx-auto">
                    <tbody>
                        <tr>
                            <td style="width: 25%;"><strong>Username</strong></td>
                            <td><input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Your Name" required></td>
                        </tr>
                        
                        <tr>
                            <td style="width: 25%;"><strong>Email</strong></td>
                            <td><input type="text" class="form-control" name="email" value="{{ $user->email }}" placeholder="Your Email" required></td>
                        </tr>
                        
                        <tr>
                            <td style="width: 25%;"><strong>Phone Number</strong></td>
                            <td><input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="Your Phone Number" required></td>
                        </tr>
                        
                        <tr>
                            <td style="width: 25%; border-bottom: none;"><strong>Address</strong></td>
                            <td style="border-bottom: none;"><input type="text" class="form-control" name="address" value="{{ $user->address }}" placeholder="Your Address" required></td>
                        </tr>
                    </tbody>
                </table>
                <div style="width: 90%;" class="text-center mx-auto justify-content-between">
                    <a href="{{ route('edit_current_user') }}"><button class="btn btn-primary">Confirm Edit</button></a>
                    
                </div>
            </form>
        </div>
    </div>
    {{-- <script>
        var alert = document.getElementsByClassName('alert');
        if(alert.length > 0){
            console.log('Alert is show');
        }   
    </script> --}}
@endsection

@push('styles')
<style>
    .user_container{
        margin-top: 20px;
        margin-bottom: 20px;
        width: 56vw;
        height: 540px;
        font-family: 'Montserrat', sans-serif;
        border: 2px solid black;
        border-radius: 15px;
    }
    .alert{
        position: absolute;
        top: 0;
        display: none;
    }
    .avatar{
        width: 110px;
        height: 110px;
        border: 2px solid black;
        border-radius: 50%;
    }
    .buttons{
        transition: background-color 500ms ease-in-out;
        border: none;
        background-color: #fff;
        width: 15vw;
        font-size: 22px;
        text-align: center;
    }
    .buttons:hover{
        background-color: #f0f0f0;
    }
    .buttons.active{
        text-decoration: underline;
        text-decoration-color: black;
        text-decoration-thickness: 3px;
        background-color: white;
    }
    .table{
        width: 97%; 
        border: 2px solid black;
        border-collapse: separate;
        overflow: hidden;
        border-radius: 15px;
        padding: 10px;
        padding-left: 30px;
        padding-right: 30px;
    }
</st>
@endpush
