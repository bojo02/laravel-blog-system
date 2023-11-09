<x-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">{{$post->title}}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Posted on {{$post->created_at->format('d/m/Y')}}, by {{$post->user->name}} {{$post->user->lastname}}</div>
                        <!-- Post categories-->
                        <h4>Tags: </h4>
                        @if(isset($tags))
                            @foreach($tags as $tag)
                                <span class="badge bg-secondary text-decoration-none link-light">{{$tag}}</span>
                            @endforeach
                        @endif
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded" src="{{asset($post->image->image_path)}}" alt="..." /></figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-4">{!! $post->content !!}</p>
                    </section>
                </article>
                <!-- Comments section-->
                <section class="mb-5">
                    <div class="card bg-light">
                        <div class="card-body">
                            @auth
                            <!-- Comment form-->
                            <form class="mb-4" action="{{route('comment.store')}}" method="POST">
                                @CSRF
                                <input type="hidden" name="commentable_id" value="{{$post->id}}">
                                <textarea name="comment" class="form-control" rows="3" placeholder="Leave a comment!"></textarea>
                                <button class="btn btn-secondary mt-2">Comment</button>                        
                            </form>
                            @else
                            <p>You have to login to comment. <a href="{{route('user.login')}}">Login now</a></p>
                            <hr>
                            @endauth
                            @error('comment')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{$message}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @enderror
                            @error('commentable_id')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{$message}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @enderror
                            @if(isset($post->comments))
                                @if($post->comments->count() > 0)
                                    @foreach ($post->comments as $comment)

                                        <div class="d-flex">
                                            <div class="flex-shrink-0"><img width="50px" height="50px" class="rounded-circle" src="{{$post->user->avatar_path}}" alt="..." /></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">{{$comment->user->name}} | @if($comment->user->id == $post->user->id) <strong>Author</strong> @endif</div>
                                               <p> {{$comment->content}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                           
                        </div>
                    </div>
                </section>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                            <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                        </div>
                    </div>
                </div>
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header">Categories: </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="list-unstyled mb-0">
                                    @foreach($post->categories as $category)
                                        <li><a href="{{route('blog.category', ['category' => $category->slug])}}">{{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>