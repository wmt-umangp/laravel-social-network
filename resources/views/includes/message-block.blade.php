@if (Session::has('message'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <span>{{Session::get('message')}}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
