@extends('layouts.master')

@section('content')
    @include('includes.message-block')
    <section class="row gx-0 gy-5 mt-5">
        <div class="col-md-12 new-posts d-flex flex-column justify-content-center align-items-center">
            <header>
                <h3 class="mb-2">What do you have to say?</h3>
            </header>
            <form action="{{ route('post.create') }}" id="createpost" method="POST">
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
                            <div class="div-body text-break"><p>{!!"<pre><span style='font-size:17px;font-family: Arial'> $post->body </span></pre>"!!}</p></div>
                            <div class="info mt-2">
                                <small>Posted By {{ $post->user->name }} on {{ $post->created_at->format('h:i:s d/m/Y') }}</small>
                            </div>
                            <div class="interaction mt-3">

                                @if($post->is_liked_by_auth_user())
                                    <a href="{{route('reply.dislike',['id'=>$post->id])}}" class="fa-solid fa-thumbs-down text-decoration-none me-3" style="font-size:25px"></a>
                                @else
                                    <a href="{{route('reply.like',['id'=>$post->id])}}" class="fa-solid fa-thumbs-up text-decoration-none me-3" style="font-size:25px"></a>
                                @endif
                                @if (Auth::user() == $post->user)
                                    <a href="#" class="text-decoration-none edit fa-solid fa-pen-to-square me-3" style="font-size:25px"></a>
                                    <a href="{{ route('post.delete', ['post_id' => $post->id]) }}"
                                        class="text-decoration-none fa-solid fa-trash-can me-3"  onclick="return confirm('Are you sure?')" style="font-size:25px"></a>
                                @endif
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="d-flex mt-3 justify-content-center">
                {!! $posts->links('vendor.pagination.custom') !!}
            </div>
        </div>
    </section>

    {{-- Modal for update --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editmodal">
                        <div class="form-group">
                            <label for="post-body">Edit The Post</label>
                            <textarea name="post-body" id="post-body" cols="30" rows="5" class="form-control" style="resize:none;"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var token = '{{ csrf_token() }}';
        var urlEdit = '{{ route('edit') }}';
    </script>
@endsection
