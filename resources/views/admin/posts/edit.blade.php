<x-admin>
    <main class="main users chart-page" id="skip-target">
        <div class="container">
          <h2 class="main-title">Edit Post</h2>

          <form class="form" action="{{route('post.update', ['post' => $post->id])}}" method="POST" enctype="multipart/form-data">
            @CSRF
            @method('PUT')
            <label class="form-label-wrapper">
              <p class="form-label">Title</p>
              <input name="title" class="form-input" value="{{old('title', $post->title)}}" type="text" placeholder="Enter post title">
                @error('title')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>
            <label class="form-label-wrapper">
              <p class="form-label">Content</p>
              <textarea class="mytextarea form-input" name="content" id="" cols="30" rows="10">{!! old('content', $post->content) !!}</textarea>
                @error('content')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>
            <label class="form-label-wrapper">
                <p class="form-label">Permalink</p>
                <input name="permalink" value="{{$post->permalink}}" class="form-input" type="text" placeholder="Enter post permalink">
                @error('permalink')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>

            <label class="form-label-wrapper">
              <p class="form-label">Tags (separate them with comma ",")</p>
              <input value="{{old('image', $tags->tags)}}" name="tags" class="form-input" type="text" placeholder="Enter tags">
            </label>

            @if(!empty($categories))
              <label class="form-label-wrapper">
                <p class="form-label">Cateogires: You can choose multiple when you hold CTRL</p>
                <select name="categories[]" class="form-select" multiple aria-label="multiple select example">
                  @foreach($categories as $cat)
                    <option @if($post->categories->contains($cat)) selected @endif value="{{$cat->id}}">{{$cat->name}}</option>
                  @endforeach
                </select>
                @error('categories')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>
            @endif

              <div class="mb-3">
                <label for="formFile" class="form-label">Choose post image</label>
                <input value="{{old('image')}}" name="image" class="form-control" type="file" id="formFile">
                @error('image')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
              </div>

            <button type="submit" class="form-btn primary-default-btn transparent-btn">Update</button>

            @if(isset($post->image))
            <div class="mt-5">
                <h3 class="mb-3">Current set image</h3>
                <img src="{{$post->image->image_path}}" alt="">
            </div>
            
          @else
            <p>There is no set image...</p>
          @endif
          </form>
        
        </div>
    </main>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
        
</x-admin>