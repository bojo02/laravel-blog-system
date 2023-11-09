<x-admin>
    <main class="main users chart-page" id="skip-target">
        <div class="container">
          <h2 class="main-title">Create Category</h2>

          <form class="form" action="{{route('admin.category.store')}}" method="POST">
            @CSRF
            <label class="form-label-wrapper">
              <p class="form-label">Name</p>
              <input name="name" class="form-input" value="{{old('name')}}" type="text" placeholder="Enter cateogry name">
                @error('name')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>
            <label class="form-label-wrapper">
                <p class="form-label">Slug</p>
                <input name="slug" class="form-input" value="{{old('slug')}}" type="text" placeholder="Enter slug">
                  @error('slug')
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{$message}}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @enderror
              </label>
            @if(!empty($categories))
              <label class="form-label-wrapper">
                <p class="form-label">Cateogires: You can choose multiple when you hold CTRL</p>
                <select name="category" class="form-select">
                  <option value="0">None</option>
                  @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
                @error('category')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>
            @endif
            <button class="btn btn-primary mt-3">Create</button>
          </form>
        
        </div>
    </main>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
        
</x-admin>