<x-admin>
    <div class="container mt-5">
        <h2 class="main-title">Slides</h2>

        <div class="elements mt-5">
            @if(!isset($slides))
            
            @else
                @foreach ($slides as $slide)
                <div class="card mt-3">
                    <div class="card-body clear">
                    <span class="text">
                        <img width="80px" height="50px" src="{{$slide->image->image_path}}" alt="">  <strong>{{$slide->title}}</strong>
                    </span>
                    <span class="actions">
                        
                        <form action="{{route('slide.delete', [$slide->id])}}" method="POST">
                            @CSRF
                            @method('delete')
                            <a href="{{route('slide.edit', ['slide' => $slide->id])}}" class="btn btn-outline-dark">Edit</a>
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </span>
                    </div>
                </div>
                @endforeach
                @if(count($slides) > 0)
                    <div class="mt-5">
                        {{$slides->links()}}
                    </div>
                @else
                <p>There aren't any slides yet</p>
                @endif
            @endif
          
        </div>
    </div>
</x-admin>