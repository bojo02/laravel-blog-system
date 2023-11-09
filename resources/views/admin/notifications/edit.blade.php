<x-admin>
    <main class="main users chart-page" id="skip-target">
        <div class="container">
          <h2 class="main-title">Edit Notification</h2>

          <div class="mt-5 mb-5 a--link">
            <p>Notification Content: </p>

            <p>{!! $notification->content !!}</p>
           </div>

           <div class="mt-5 mb-5">
            <form action="{{route('notification.delete', [$notification->id])}}" method="POST">
              @CSRF
              @method('delete')
            @if($notification->seen == 0)
            <a href="{{route('notification.seen', ['notification' => $notification->id])}}" class="btn btn-outline-success">Mark Seen</a>
            @else
            <a href="{{route('notification.unseen', ['notification' => $notification->id])}}" class="btn btn-outline-secondary">Mark Unseen</a>
            @endif
            <button type="submit" class="btn btn-outline-danger">Delete</button>
             </form>
           </div>

          <form class="form" action="{{route('notification.update', ['notification' => $notification->id])}}" method="POST" enctype="multipart/form-data">
            @CSRF
            @method('PUT')
            <label class="form-label-wrapper">
              <p class="form-label">Title</p>
              <input name="title" class="form-input" value="{{old('title', $notification->title)}}" type="text" placeholder="Enter post title">
                @error('title')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </label>
            <label class="form-label-wrapper">
              <p class="form-label">Content</p>
              <textarea class="mytextarea form-input" name="content" id="" cols="30" rows="10">{!! old('content', $notification->content) !!}</textarea>
                @error('content')
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

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
        
</x-admin>