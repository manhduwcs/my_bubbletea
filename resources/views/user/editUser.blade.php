@extends('layouts.app')

@section('content')
    <div class="user_container mx-auto">
        <div class="d-flex ms-4 mt-4">
            <img class="avatar" src="{{ asset($user->avatar) }}" alt="User Image">
            <div class="d-block ms-5 mt-3">
                <h2>{{ $user->name }}</h2>
                <h4>{{ $badge }}</h4>
            </div>
        </div>
        {{-- Thong bao loi --}}
        <div class="mt-3">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="list-style-type: none;">
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
                <div id="alert_success" class="alert alert-success">
                    {{ $success }}
                </div>
            @endif 
        </div>
        <div style="width: 90%;" class="d-flex mx-auto mt-5 justify-content-between" id="buttons_container">
            <a href="{{ route('show_current_user') }}"><button class="buttons">User Information</button></a>
            <button class="buttons active">Edit Profile</button>
            <button type="submit" class="buttons" onclick="logout()">Log Out</button>
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
                    <a href="{{ route('edit_current_user') }}"><button type="submit" class="btn btn-primary">Confirm Edit</button></a>
                    <a href="{{ route('show_user_changepass') }}"><button type="button" class="btn btn-primary">Change your Password</button></a>
                    <a href="{{ route('show_user_forgetpass') }}"><button type="button" class="btn btn-primary">Forget your Password ?</button></a>
                </div>
            </form>
        </div>
        <div id="logout_box" class="logout_box d-flex mx-auto align-items-center d-none">
            <div style="width: 90%;" class="mx-auto text-center">
                <h4 class="text-center">Do you want to log out ?</h4>
                <div class="mt-4 d-flex justify-content-center">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" style="margin-right: 30px; width: 60px; height: 40px;" class="btn btn-danger">Yes</button>
                    </form>
                    <button style="width: 60px; height: 40px;" class="btn btn-success" onclick="cancel()">No</button>
                </div>
            </div>
        </div>
    </div>
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
    .logout_box{
        width: 25vw;
        height: 20vw;
        position: fixed;
        top: 25%;
        left: 37%;
        border: 2px solid black;
        border-radius: 10px;
        background-color: #fff;
    }
    .avatar{
        width: 110px;
        height: 110px;
        border: 2px solid black;
        border-radius: 50%;
        
    }
    .alert{
        max-width: 20vw;
        display: block;
        position: absolute;
        top: 2%;
        right: 1%;
        opacity: 0;
        transition: opacity 300ms ease-in-out
    }
    .alert.show{
        opacity: 1;
    }
    .alert.hide{
        opacity: 0;
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
</style>
@endpush

@push('scripts')
    <script>
        let alert = document.getElementsByClassName('alert');
        let logout_box = document.getElementById('logout_box');
        
        function logout(){
            logout_box.classList.remove('d-none');
            logout_box.classList.add('d-flex');
        }

        function cancel(){
            logout_box.classList.remove('d-flex');
            logout_box.classList.add('d-none');
        }

        if (alert.length > 0) {
            setInterval(() => {
                for(let i=0; i<alert.length; i++){
                    alert[i].classList.add('show');
                }
            }, 200);

            setInterval(() => {
                for(let i=0; i<alert.length; i++){
                    alert[i].classList.remove('show');
                    alert[i].classList.add('hide');
                }
            }, 3000);
        }
    </script>
@endpush

