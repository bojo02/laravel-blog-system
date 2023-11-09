<x-admin>
    <main class="main users chart-page" id="skip-target">
        <div class="container">
          <h2 class="main-title">Edit Slide</h2>

          <form class="form" action="{{route('slide.update', ['slide' => $slide->id])}}" method="POST" enctype="multipart/form-data">
            @CSRF
            @method('PUT')
            <label class="form-label-wrapper">
              <p class="form-label">Title</p>
              <input name="title" class="form-input" value="{{old('title', $slide->title)}}" type="text" placeholder="Enter title">
                @error('title')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>
            <label class="form-label-wrapper">
                <p class="form-label">Description</p>
                <input name="description" class="form-input" value="{{old('description', $slide->description)}}" type="text" placeholder="Enter description">
                  @error('description')
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{$message}}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @enderror
              </label>
              <label class="form-label-wrapper">
                <p class="form-label">Order number (The lower you choose, around the first will come)</p>
                <input name="order" class="form-input" value="{{old('order', $slide->order)}}" type="text" placeholder="Enter order number">
                  @error('order')
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{$message}}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @enderror
              </label>
              <div class="mb-3">
                <label for="formFile" class="form-label">Choose slide image</label>
                <input value="{{old('image')}}" name="image" class="form-control" type="file" id="formFile">
                @error('image')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
              </div>
            <button class="btn btn-primary mt-3">Update</button>
          </form>

          <div class="mt-5 mb-5">
            <h2 class="mb-3">Current image set</h2>
            <img src="{{$slide->image->image_path}}" alt="">
          </div>
        
        </div>
    </main>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
        
</x-admin>