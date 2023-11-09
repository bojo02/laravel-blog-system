<x-admin>
    <main class="main users chart-page" id="skip-target">
        <div class="container">
          <h2 class="main-title">Edit NewsLetter</h2>

          <form class="form" action="{{route('newsletter.update', ['newsLetter' => $newsletter->id])}}" method="POST" enctype="multipart/form-data">
            @CSRF
            @method('PUT')
            <label class="form-label-wrapper">
              <p class="form-label">Title</p>
              <input name="title" class="form-input" value="{{old('title', $newsletter->title)}}" type="text" placeholder="Enter title">
                @error('title')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>
            <label class="form-label-wrapper">
                <p class="form-label">Subject</p>
                <input name="subject" class="form-input" value="{{old('subject', $newsletter->subject)}}" type="text" placeholder="Enter subject">
                  @error('subject')
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{$message}}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @enderror
              </label>
            <label class="form-label-wrapper">
                <p class="form-label">Content</p>
                <textarea name="content" class="form-control" id="" rows="3">{{old('content', $newsletter->content)}}</textarea>
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