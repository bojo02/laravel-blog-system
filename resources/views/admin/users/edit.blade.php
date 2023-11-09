<x-admin>
    <main class="main users chart-page" id="skip-target">
        <div class="container">
          <h2 class="main-title">Edit User</h2>

          <form class="form" action="{{route('user.admin.update', ['user' => $user->id])}}" method="POST" enctype="multipart/form-data">
            @CSRF
            @method('PUT')
            <label class="form-label-wrapper">
              <p class="form-label">Name</p>
              <input name="name" class="form-input" value="{{old('name', $user->name)}}" type="text" placeholder="Enter First Name">
                @error('name')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>
            <label class="form-label-wrapper">
                <p class="form-label">Last Name</p>
                <input name="lastname" class="form-input" value="{{old('lastname',  $user->lastname)}}" type="text" placeholder="Enter Last Name">
                  @error('lastname')
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{$message}}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @enderror
              </label>

              <label class="form-label-wrapper">
                <p class="form-label">Email</p>
                <input name="email" class="form-input" value="{{old('email',  $user->email)}}" type="email" placeholder="Enter email">
                  @error('email')
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{$message}}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @enderror
              </label>

              <label class="form-label-wrapper">
                <p class="form-label">Password</p>
                <input name="password" class="form-input" value="{{old('password')}}" type="password" placeholder="Enter password">
                  @error('password')
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{$message}}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @enderror
              </label>

              <label class="form-label-wrapper">
                <p class="form-label">Password Confirmation</p>
                <input name="password_confirmation" class="form-input" value="{{old('password_confirmation')}}" type="password" placeholder="Confirm Password">
                  @error('password_confirmation')
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{$message}}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @enderror
              </label>
              <div class="mb-3">
                <label for="formFile" class="form-label">Choose avatar</label>
                <input value="{{old('image')}}" name="image" class="form-control" type="file" id="formFile">
                @error('image')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
              </div>
              <div class="form-check form-switch mb-3 mt-3">
                <input @if($user->is_admin == 1) checked @endif name="is_admin" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Make Admin</label>
              </div>

            <button type="submit" class="form-btn primary-default-btn transparent-btn">Update</button>

            <div class="mt-5">
              <h3 class="main-title">Current avatar</h3><br>

              <img width="100px" height="100px" src="{{$user->avatar_path}}" alt="">
            </div>
          </form>

          
        </div>
    </main>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
        
</x-admin>