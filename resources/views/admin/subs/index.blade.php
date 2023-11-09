<x-admin>
    <div class="container mt-5">
        <form action="{{route('subs.search')}}">
            <div class="form-group clear">
              <label class="main-title" for="forsearch">Subscribers List</label>
              <a href="{{route('sub.create')}}" style="float:right;" class="btn btn-primary mb-3"><i class="fa-solid fa-plus"></i> Create Sub</a>
              <input name="search" type="text" value="@if(isset($searchterm)){{$searchterm}}@endif" class="form-control" id="forsearch" aria-describedby="emailHelp" placeholder="Search...">
            </div>
            <button type="submit" class="btn btn-success mt-3">Search</button>
          </form>
         

        <div class="elements mt-5">
            @if(!isset($subs))
           
            @else
                @foreach ($subs as $sub)
                <div class="card mt-3">
                    <div class="card-body clear">
                    <span class="text">
                        {{$sub->name}} | {{$sub->email}}
                    </span>
                    <span class="actions">
                        
                        <form action="{{route('sub.delete', [$sub->id])}}" method="POST">
                            @CSRF
                            @method('delete')
                            <a href="{{route('sub.edit', ['sub' => $sub->id])}}" class="btn btn-outline-dark">Edit</a>
                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </span>
                    </div>
                </div>
                @endforeach
                @if(count($subs) > 0)
                    <div class="mt-5">
                        {{$subs->links()}}
                    </div>
                @else
                <p>There aren't any subsribers yet</p>
                @endif
            @endif
          
        </div>
    </div>
</x-admin>