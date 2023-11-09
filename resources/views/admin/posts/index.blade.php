<x-admin>
    <div class="container mt-5">
        <h2 class="main-title">Posts list</h2>

        <div class="elements mt-5">
            @if(!isset($posts))
            <p class="center">There aren't any posts yet</p>
            @else
                @foreach ($posts as $post)
                <div class="card ">
                    <div class="card-body clear">
                    <span class="text">
                        {{$post->id}} | {{$post->title}} - <strong>{{$post->user->name}}</strong>
                    </span>
                    <span class="actions">
                        
                        <form action="{{route('post.delete', [$post->id])}}" method="POST">
                            @CSRF
                            @method('delete')
                            <a href="{{route('post.admin.edit', ['post' => $post->id])}}" class="btn btn-outline-dark">Edit</a>
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </span>
                    </div>
                </div>
                @endforeach
                @if(count($posts) > 0)
                    <div class="mt-5">
                        {{$posts->links()}}
                    </div>
                @else
                <p>There aren't any posts yet</p>
                @endif
            @endif
          
        </div>
    </div>
</x-admin>