<x-admin>
    <main class="main users chart-page" id="skip-target">
        <div class="container">
          <h2 class="main-title">Create a new Sub</h2>

          <form class="form" action="{{route('sub.store')}}" method="POST">
            @CSRF
            <label class="form-label-wrapper">
              <p class="form-label">Name</p>
              <input name="name" class="form-input" value="{{old('name')}}" type="text" placeholder="Enter Name">
                @error('name')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>
          

              <label class="form-label-wrapper">
                <p class="form-label">Email</p>
                <input name="email" class="form-input" value="{{old('email')}}" type="email" placeholder="Enter email">
                  @error('email')
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{$message}}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @enderror
              </label>

            <button type="submit" class="form-btn primary-default-btn transparent-btn">Create</button>
          </form>
        </div>
    </main>
</x-admin>