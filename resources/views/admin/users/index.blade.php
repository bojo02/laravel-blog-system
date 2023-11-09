<x-admin>
    <div class="container mt-5">
        <form action="{{route('admin.users.index.search')}}">
            <div class="form-group">
              <label class="main-title" for="forsearch">Users List | Search user by name or email</label>
              <input name="search" type="text" value="@if(isset($searchterm)){{$searchterm}}@endif" class="form-control" id="forsearch" aria-describedby="emailHelp" placeholder="Search...">
            </div>
            <button type="submit" class="btn btn-success mt-3">Search</button>
          </form>

        <div class="elements mt-5">
            @if(!isset($users))
           
            @else
                @foreach ($users as $user)
                <div class="card mt-3">
                    <div class="card-body clear">
                    <span class="text">
                        {{$user->id}} | {{$user->name}} {{$user->lastname}} | {{$user->email}} @if($user->is_admin) | <strong>Admin</strong> @endif
                    </span>
                    <span class="actions">
                        
                        <form action="{{route('user.delete', [$user->id])}}" method="POST">
                            @CSRF
                            @method('delete')
                            <a href="{{route('user.admin.edit', ['user' => $user->id])}}" class="btn btn-outline-dark">Edit</a>
                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </span>
                    </div>
                </div>
                @endforeach
                @if(count($users) > 0)
                    <div class="mt-5">
                        {{$users->links()}}
                    </div>
                @else
                <p>There aren't any users yet</p>
                @endif
            @endif
          
        </div>
    </div>
</x-admin>