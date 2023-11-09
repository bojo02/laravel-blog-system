<x-admin>
    <main class="main users chart-page" id="skip-target">
        <div class="container">
          <h2 class="main-title">Edit Question and Answer</h2>

          <form class="form" action="{{route('faq.update', ['faq' => $faq->id])}}" method="POST">
            @CSRF
            @method('PUT')
            <label class="form-label-wrapper">
              <p class="form-label">Title</p>
              <input name="title" class="form-input" value="{{old('title', $faq->title)}}" type="text" placeholder="Enter title">
                @error('title')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>
            <label class="form-label-wrapper">
                <p class="form-label">Content</p>
                <textarea name="content" class="form-control" id="" rows="3">{{old('content', $faq->content)}}</textarea>
                  @error('content')
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{$message}}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @enderror
              </label>
            <button class="btn btn-primary mt-3">Update</button>
          </form>
        
        </div>
    </main>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
        
</x-admin>