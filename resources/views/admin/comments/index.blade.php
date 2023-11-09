<x-admin>
    <div class="container mt-5">
        <h2 class="main-title">Comments list</h2>

        <div class="elements mt-5">
            @if(!isset($comments))
            
            @else
                @foreach ($comments as $comment)
                <div class="card mt-2">
                    <div class="card-body clear">
                    <span class="text">
                        {{$comment->id}} | {{$comment->content}} - <strong>{{$comment->user->name}}</strong>
                    </span>
                    <span class="actions">
                        
                        <form action="{{route('comment.delete', [$comment->id])}}" method="POST">
                            @CSRF
                            @method('delete')
                            <a href="{{route('comment.admin.edit', ['comment' => $comment->id])}}" class="btn btn-outline-dark">Edit</a>
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </span>
                    </div>
                </div>
                @endforeach
                @if(count($comments) > 0)
                    <div class="mt-5">
                        {{$comments->links()}}
                    </div>
                @else
                <p>There aren't any comments yet</p>
                @endif
            @endif
          
        </div>
    </div>
</x-admin>