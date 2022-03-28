@extends('layouts.master')

@section('content')
    @include('includes.message-block')
    <section class="row gx-0 gy-5 mt-5">
    <div class="col-md-12 new-posts d-flex flex-column justify-content-center align-items-center">
        <header>
            <h3 class="mb-2">What do you have to say?</h3>
        </header>
        <form action="{{route('post.create')}}" method="POST">
            @csrf
            <div class="form-group">
                <textarea name="body" id="body" class="form-control mb-2" cols="40" rows="5" placeholder="Your Post"></textarea>
                @if ($errors->has('body'))
                    <p><span class="text-danger">*{{ $errors->first('body') }}</span></p>
                @endif
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Create Post</button>
            </div>
        </form>
    </div>
    <hr>
    <div class="col-md-12 posts d-flex flex-column justify-content-center align-items-center">
        <header>
            <h3>What other people say</h3>
        </header>
        @foreach ($posts as $post)
            <article class="post">
                <p>{{$post->body}}</p>
                <div class="info">
                    Posted By {{$post->user->name}} on {{$post->created_at->format('h:i:s d/m/Y')}}
                </div>
                <div class="interaction">
                    <a href="#" class="text-decoration-none">Like</a> |
                    <a href="#" class="text-decoration-none">Dislike</a> |
                    <a href="#" class="text-decoration-none">Edit</a> |
                    <a href="{{ route('post.delete',['post_id'=>$post->id])}}" class="text-decoration-none">Delete</a> |
                </div>
            </article>
        @endforeach

    </div>
</section>
@endsection
