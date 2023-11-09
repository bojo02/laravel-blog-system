<x-admin>
    <div class="container mt-5">
        <h2 class="main-title">FAQ's</h2>

        <div class="elements mt-5">
            @if(!isset($faqs))
            
            @else
                @foreach ($faqs as $faq)
                <div class="card mt-3">
                    <div class="card-body clear">
                    <span class="text">
                        <strong>{{$faq->title}}</strong>
                    </span>
                    <span class="actions">
                        
                        <form action="{{route('faq.delete', [$faq->id])}}" method="POST">
                            @CSRF
                            @method('delete')
                            <a href="{{route('faq.edit', ['faq' => $faq->id])}}" class="btn btn-outline-dark">Edit</a>
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </span>
                    </div>
                </div>
                @endforeach
                @if(count($faqs) > 0)
                    <div class="mt-5">
                        {{$faqs->links()}}
                    </div>
                @else
                <p>There aren't any FAQ's yet</p>
                @endif
            @endif
          
        </div>
    </div>
</x-admin>