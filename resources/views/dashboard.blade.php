@extends('layouts.master')

@section('content')
    @include('includes.message-block')
    <section class="row gx-0 gy-5 mt-5">
        <div class="col-md-12 new-posts d-flex flex-column justify-content-center align-items-center">
            <header>
                <h3 class="mb-2">What do you have to say?</h3>
            </header>
            <form action="{{ route('post.create') }}" method="POST">
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
        <div class="col-md-12 posts">
            <div class="row gy-3">
                <header>
                    <h3 class="text-center">What other people say</h3>
                </header>
                @foreach ($posts as $post)
                    <div class="col-md-4">
                        <article class="post" data-postid="{{ $post->id }}">
                            <div class="div-body text-break">
                                <p>{{ $post->body }}</p>
                            </div>
                            <div class="info mt-2">
                                <small>Posted By {{ $post->user->name }} on
                                    {{ $post->created_at->format('h:i:s d/m/Y') }}</small>
                            </div>
                            <div class="interaction mt-3">
                                <a href="#"
                                    class="text-decoration-none like ">{{ Auth::user()->likes()->where('post_id', $post->id)->first()? (Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1? 'You like this post': 'Like'): 'Like' }}</a>
                                |
                                <a href="#"
                                    class="text-decoration-none like">{{ Auth::user()->likes()->where('post_id', $post->id)->first()? (Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0? 'You don\'t like this post': 'Dislike'): 'Dislike' }}</a>
                                |
                                @if (Auth::user() == $post->user)
                                    <a href="#" class="text-decoration-none edit ">Edit</a> |
                                    <a href="{{ route('post.delete', ['post_id' => $post->id]) }}"
                                        class="text-decoration-none">Delete</a>
                                @endif
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- Modal for update --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post-body">Edit The Post</label>
                            <textarea name="post-body" id="post-body" cols="30" rows="5" class="form-control" style="resize:none;"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var token = '{{ csrf_token() }}';
        var urlEdit = '{{ route('edit') }}';
        var urlLike = '{{ route('like') }}'
    </script>
@endsection
