<x-admin>
    <main class="main users chart-page" id="skip-target">
        <div class="container">
          <h2 class="main-title">Edit Sub</h2>

          <form class="form" action="{{route('sub.update', ['sub' => $sub->id])}}" method="POST">
            @CSRF
            @method('PUT')
            <label class="form-label-wrapper">
              <p class="form-label">Name</p>
              <input name="name" class="form-input" value="{{old('name', $sub->name)}}" type="text" placeholder="Enter Name">
                @error('name')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>
          

              <label class="form-label-wrapper">
                <p class="form-label">Email</p>
                <input name="email" class="form-input" value="{{old('email', $sub->email)}}" type="email" placeholder="Enter email">
                  @error('email')
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{$message}}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @enderror
              </label>

            <button type="submit" class="form-btn primary-default-btn transparent-btn">Update</button>
          </form>
        </div>
    </main>
</x-admin>