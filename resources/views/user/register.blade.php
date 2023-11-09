<x-layout>
    <section class=" gradient-custom">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
      
                  <div class="mb-md-5 mt-md-4 pb-5">
                    <form action="{{route('user.store')}}" method="POST">
                        @CSRF
                    <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
                    <p class="text-white-50 mb-5">Please, fill out the form to register!</p>

                    <div class="form-outline form-white mb-4">
                        <input placeholder="Your name" name="name" type="text" id="typeEmailX" value="{{old('name')}}" class="form-control form-control-lg" />
                        <label class="form-label" for="typeEmailX">Name</label>
                        @error('name')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{$message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>

                   

                    <div class="form-outline form-white mb-4">
                        <input placeholder="Your last name" name="lastname" type="text" id="typeEmailX" value="{{old('lastname')}}" class="form-control form-control-lg" />
                        <label class="form-label" for="typeEmailX">Last Name</label>
                        @error('lastname')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{$message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>
      
                    <div class="form-outline form-white mb-4">
                      <input placeholder="Your email" name="email" type="email" id="typeEmailX" value="{{old('email')}}" class="form-control form-control-lg" />
                      <label class="form-label" for="typeEmailX">Email</label>
                        @error('email')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{$message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>
      
                    <div class="form-outline form-white mb-4">
                      <input placeholder="Your password" name="password" type="password" id="typePasswordX" class="form-control form-control-lg" />
                      <label class="form-label" for="typePasswordX">Password</label>
                      @error('password')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{$message}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input placeholder="Confirm password" name="password_confirmation" type="password" id="typePasswordX" class="form-control form-control-lg" />
                        <label class="form-label" for="typePasswordX">Password Confirmation</label>
                    </div>
      
                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Register</button>
      
                    <div class="d-flex justify-content-center text-center mt-4 pt-1">
                      <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                      <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                      <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                    </div>
                </form>
                  </div>
      
                  <div>
                    <p class="mb-0">Alreay have an account? <a href="{{route('user.login')}}" class="text-white-50 fw-bold">Sign In</a>
                    </p>
                  </div>
      
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</x-layout>