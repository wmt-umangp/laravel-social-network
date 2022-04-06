@extends('layouts.master')

@section('title')
    Account
@endsection

@section('content')
<section class="row new-post justify-content-center mt-5">
    <div class="col-md-6 col-md-offset-3">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="card-header">
                <h3 class="text-center">Your Account</h3>
              </div>
            <div class="row g-0">
              <div class="col-12 col-md-5 ">
                <img src="{{url('uploads/images/User-'.$user->id.'/',$user->image)}}" alt="" class="img-responsive" width='200' height='200'>
              </div>
              <div class="col-12 col-md-7 ">
                <div class="card-body"> 
                    <p><i class="fa-solid fa-user text-primary"></i><span class="card-title ms-2 h5">{{ $user->name}}</span></p>
                    <p><i class="fa-solid fa-envelope text-primary"></i><span class="card-text ms-2">{{$user->email}}</span></p>
                    <p><a href="{{ route('editaccount')}}" class="btn btn-primary mt-4"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile</a></p>
                </div>
              </div>
            </div>
          </div>
</section>

@endsection


