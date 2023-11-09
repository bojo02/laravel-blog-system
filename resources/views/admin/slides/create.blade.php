<x-admin>
    <main class="main users chart-page" id="skip-target">
        <div class="container">
          <h2 class="main-title">Create Slide</h2>

          <form class="form" action="{{route('slide.store')}}" method="POST" enctype="multipart/form-data">
            @CSRF
            <label class="form-label-wrapper">
              <p class="form-label">Title</p>
              <input name="title" class="form-input" value="{{old('title')}}" type="text" placeholder="Enter title">
                @error('title')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>
            <label class="form-label-wrapper">
                <p class="form-label">Description</p>
                <input name="description" class="form-input" value="{{old('description')}}" type="text" placeholder="Enter description">
                  @error('description')
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{$message}}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @enderror
              </label>
              <label class="form-label-wrapper">
                <p class="form-label">Order number (The lower you choose, around the first will come)</p>
                <input name="order" class="form-input" value="{{old('order')}}" type="text" placeholder="Enter order number">
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
            <button class="btn btn-primary mt-3">Create</button>
          </form>
        
        </div>
    </main>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
        
</x-admin>