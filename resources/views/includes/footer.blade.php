
  <footer class="bg-light text-center text-white">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
    <h4 style="color:black;">Subscribe to recieve our latest posts!</h4>
    <form class="form" action="{{route('sub.new')}}" method="POST">
      @CSRF
    <div class="input-group mb-3">
        
        <span class="input-group-text">Your name</span>
        <input name="name" type="text" class="form-control" placeholder="Name" aria-label="Name">
        <span class="input-group-text">Your email</span>
        <input name="email" type="email" class="form-control" placeholder="Email" aria-label="Email">
        <button type="submit" class="btn btn-primary">Subscribe</button>
    
    </div>
  </form>
  
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color:black;">
    © {{date('Y')}} Copyright:
        <a class="text-reset fw-bold" href="https://saitmax.com/">SaitMax.com</a> Design  
        <p>
          <button type="button" class="btn btn-danger mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Remove from newsletter
          </button>
        </p>
  </div>
  
  <!-- Copyright -->
</footer>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remove email from the list</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('sub.user.delete')}}" method="POST">
          @CSRF
          @method('delete')
          <input name="email" type="email" class="form-control" placeholder="Email" aria-label="Email">

          <button class="btn btn-danger mt-3">Remove from the list</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  