<x-layout>
    <main class="my-5">
        <div class="container">
          <!--Section: Content-->
          <section class="text-center">
            <h4 class="mb-5">Search: <strong>{{$searchterm}}</strong></h4>
    
            <div class="row">
              @if(!isset($posts))
              <p class="center">There aren't any posts yet...</p>
              @else
                @foreach ($posts as $post)
                <div class="col-lg-4 col-md-12 mb-4">
                  <div class="card">
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                      @if($post->image)
                      <img src="{{$post->image->image_path}}" class="img-fluid" />
                      @endif
                      <a href="#!">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                      </a>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">{{$post->title}}</h5>
                      <a href="{{route('post.show', ['post' => $post->permalink])}}" class="btn btn-primary mt-3">Read More</a>
                    </div>
                  </div>
                </div>
                @endforeach

                @if(count($posts) > 0)
                    <div>
                        {{$posts->links()}}
                    </div>
                @else
                <p>There aren't any posts yet</p>
                @endif
              @endif
              
    
            
            </div>
          </section>
          <!--Section: Content-->
    
         
        </div>
      </main>
</x-layout>