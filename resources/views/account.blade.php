@extends('layouts.master')

@section('title')
    Account
@endsection

@section('content')
<section class="row new-post">
    <div class="col-md-6 col-md-offset-3">
        <header><h3>Your Account</h3></header>
        <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <label for="first_name">First Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" id="first_name">
                @if ($errors->has('name'))
                    <span class="text-danger">*{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group mb-4">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control" id="image">
                @if ($errors->has('image'))
                    <span class="text-danger">*{{ $errors->first('image') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Save Account</button>

        </form>
    </div>
</section>
@if (Storage::disk('local')->has($user->name . '-' . $user->id.'.jpg'))
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <img src="{{ route('account.image', ['filename' => $user->name . '-' . $user->id . '.jpg']) }}" alt="" class="img-responsive" width='200' height='200'>
        </div>
    </section>
@endif
@endsection
