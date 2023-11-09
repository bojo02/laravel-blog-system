<x-admin>
    <div class="container mt-5">
        <h1 class="main-title" for="forsearch">Categories list</h1>

        <div class="elements mt-5">
            @if(!isset($categories))
           
            @else
                @foreach ($categories as $category)
                <div class="card mt-3">
                    <div class="card-body clear">
                    <span class="text">
                        {{$category->name}}
                    </span>
                    <span class="actions">
                        
                        <form action="{{route('category.delete', ['category' => $category->id])}}" method="POST">
                            @CSRF
                            @method('delete')
                            <a href="{{route('category.admin.edit', ['category' => $category->id])}}" class="btn btn-outline-dark">Edit</a>
                            <button onclick="return confirm('Are you sure? It will delete all the subcategories...')" type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </span>
                    </div>
                   
                </div>
                @if(!empty($category->subCategory))
                @include('includes.category-recursive', ['subs' => $category->subCategory])
            @endif
                @endforeach
                @if(count($categories) > 0)
                    <div class="mt-5">
                        {{$categories->links()}}
                    </div>
                @else
                <p>There aren't any categories yet</p>
                @endif
            @endif
          
        </div>
    </div>
</x-admin>