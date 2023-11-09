<x-admin>
    <div class="container mt-5">
        <form action="{{route('newsletter.search')}}">
            <div class="form-group clear">
              <label class="main-title" for="forsearch">All NewsLetters</label>
              <a href="{{route('newsletter.create')}}" style="float:right;" class="btn btn-primary mb-3"><i class="fa-solid fa-plus"></i> Create NewsLetter</a>
              <input name="search" type="text" value="@if(isset($searchterm)){{$searchterm}}@endif" class="form-control" id="forsearch" aria-describedby="emailHelp" placeholder="Search...">
            </div>
            <button type="submit" class="btn btn-success mt-3">Search</button>
          </form>
         

        <div class="elements mt-5">
            @if(!isset($newsletters))
           
            @else
                @foreach ($newsletters as $newsletter)
                <div class="card mt-3">
                    <div class="card-body clear">
                    <span class="text">
                        {{$newsletter->title}} | Sent to: {{$newsletter->count}} users 
                    </span>
                    <span class="actions">
                        
                        <form action="{{route('newsletter.delete', ['newsLetter' => $newsletter->id])}}" method="POST">
                            @CSRF
                            @method('delete')
                            <a href="{{route('newsletter.show', ['newsLetter' => $newsletter->id])}}" class="btn btn-outline-success">Show</a>
                            <a href="{{route('newsletter.edit', ['newsLetter' => $newsletter->id])}}" class="btn btn-outline-dark">Edit</a>
                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </span>
                    </div>
                </div>
                @endforeach
                @if(count($newsletters) > 0)
                    <div class="mt-5">
                        {{$newsletters->links()}}
                    </div>
                @else
                <p>There aren't any newsletters yet</p>
                @endif
            @endif
          
        </div>
    </div>
</x-admin>