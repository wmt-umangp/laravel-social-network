@extends('layouts.master')

@section('title')
    Welcome!!
@endsection

@section('content')
    <div class="row mt-5 gx-5">
        <div class="col-md-6">
            <img src="https://s3.amazonaws.com/paperform-blog/2021/08/Blog-feature-image---purple--12-.png" width='100%' height="100%" alt="Signin">
        </div>
        <div class="col-md-6">
            <h3 class="text-center">Sign In</h3>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password">
                </div>
                <button type="button" class="btn btn-primary" name="submit">Sign In</button>
                <a href="/signup" class="ms-2 text-decoration-none">create account</a>
            </form>
        </div>
    </div>
@endsection
