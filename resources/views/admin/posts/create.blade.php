<x-admin>
    <main class="main users chart-page" id="skip-target">
        <div class="container">
          <h2 class="main-title">Create a new Post</h2>

          <form class="form" action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
            @CSRF
            <label class="form-label-wrapper">
              <p class="form-label">Title</p>
              <input name="title" class="form-input" value="{{old('title')}}" type="text" placeholder="Enter post title">
                @error('title')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>
            <label class="form-label-wrapper">
              <p class="form-label">Content</p>
              <textarea class="mytextarea form-input" name="content" id="" cols="30" rows="10">{{old('content')}}</textarea>
                @error('content')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>
            <label class="form-label-wrapper">
                <p class="form-label">Permalink</p>
                <input name="permalink" class="form-input" type="text" placeholder="Enter post permalink">
                @error('permalink')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>

            <label class="form-label-wrapper">
              <p class="form-label">Tags (separate them with comma ",")</p>
              <input name="tags" class="form-input" type="text" placeholder="Enter tags">
            </label>

            @if(!empty($categories))
              <label class="form-label-wrapper">
                <p class="form-label">Cateogires: You can choose multiple when you hold CTRL</p>
                <select name="categories[]" class="form-select" multiple aria-label="multiple select example">
                  @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
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

            <button type="submit" class="form-btn primary-default-btn transparent-btn">Publish</button>
          </form>
        </div>
    </main>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
        
</x-admin>