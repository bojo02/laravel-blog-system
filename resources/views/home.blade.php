<x-layout>
    @include('includes.carousel')

    <div class="container mt-5 mb-5">
        <h1 class="center">Want to learn more about me?</h1>
        <p class="center">Check out my latest articles. I think you will like them a lot!</p>
        <div class="row mb-5">

            @if(count($posts) == 0)
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

              <div class="mb-5 center">
                <a href="{{route('blog.index')}}" class="btn btn-dark">Check more</a>
            </div>
            @endif
            
  
          
         
        </div>

        
        @if(count($faqs) > 0)
        <div class="center">
            <h2>Frequently asked questions</h2>
        </div>
        @include('includes.accordion')
        @endif


    </div>
</x-layout>