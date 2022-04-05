@extends('layouts.master-2')

@section('title')
   Signup
@endsection

@section('content')
    <div class="row mt-5 gx-5">
        <div class="col-md-6 mt-5">
            <img src="https://s3.amazonaws.com/paperform-blog/2021/08/Blog-feature-image---purple--12-.png" width='100%' height="100%" alt="Signup">
        </div>
        <div class="col-md-6 mt-5">
            <h3 class="text-center">Sign Up</h3>
            <form action="{{ route('signup') }}" method="post" id="signup" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter your Name" value="{{old('name')}}">
                    @if ($errors->has('name'))
                        <span class="text-danger">*{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email" value="{{old('email')}}">
                    @if ($errors->has('email'))
                        <span class="text-danger">*{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password">
                    @if ($errors->has('password'))
                        <span class="text-danger">*{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="cpassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Enter your Confirm Password">
                    @if ($errors->has('cpassword'))
                        <span class="text-danger">*{{ $errors->first('cpassword') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
                <a href="/" class="ms-2 text-decoration-none">alreay have account?</a>
            </form>
        </div>
    </div>
@endsection
