@extends('layouts.master')

@section('title')
    Account
@endsection

@section('content')
<section class="row new-post justify-content-center mt-5">
    <div class="col-md-6 col-md-offset-3">
        <header><h3>Update Account</h3></header>
        <form action="{{ route('account.save') }}" method="post" id="account" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <label for="first_name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" id="first_name">
                @if ($errors->has('name'))
                    <span class="text-danger">*{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group mb-4">
                <label for="image">Image</label>
                <span>
                    <i class="fa-solid fa-circle-info text-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="*Image Size Must be Less Than 3 MB" style="font-size: 20px"></i>
                </span>
                <input type="file" name="image" class="form-control" id="image">
                @if ($errors->has('image'))
                    <span class="text-danger">*{{ $errors->first('image') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary me-2">Update Account</button>
            <a class="btn btn-danger" href="{{ route('account') }}">Cancel</a>

        </form>
    </div>
</section>

@endsection

