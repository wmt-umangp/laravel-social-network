@extends('layouts.master-2')

@section('title')
    Login
@endsection

@section('content')
    <div class="row mt-5 gx-5">
        <div class="col-md-6 mt-5">
            <img src="https://s3.amazonaws.com/paperform-blog/2021/08/Blog-feature-image---purple--12-.png" width='100%' height="100%" alt="Signin">
        </div>
        <div class="col-md-6 mt-5">
            <h3 class="text-center">Sign In</h3>
            <form action="{{ route('signin') }}" method="POST" id="signin" novalidate>
                @csrf
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
                <button type="submit" class="btn btn-primary" name="submit">Sign In</button>
                <a href="/signup" class="ms-2 text-decoration-none">create account</a>
            </form>
            @if(Session::has('logerror'))
            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                <span>{{Session::get('logerror')}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        </div>
    </div>
@endsection
