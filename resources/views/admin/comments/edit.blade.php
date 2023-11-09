<x-admin>
    <div class="container mt-5">
        <h2 class="main-title">Edit Comment <a href="{{route('user.admin.edit', ['user' => $comment->user->id])}}">{{$comment->user->name}} {{$comment->user->lastname}}</a></h2>

        <form class="form" action="{{route('comment.update', ['comment' => $comment->id])}}" method="POST" enctype="multipart/form-data">
            @CSRF
            @METHOD('PUT')
            <p class="form-label">Comment by {{$comment->user->name}}</p>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$comment->content}}</textarea>
            </div>
            @error('comment')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$message}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</x-admin>