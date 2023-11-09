<x-admin>
    <main class="main users chart-page" id="skip-target">
        <div class="container">
          <h2 class="main-title">Edit NewsLetter</h2>

          <h2 class="form-label">Title</h2>
            <label class="form-label-wrapper">
              - {{$newsletter->title}}
            </label>
            <label class="form-label-wrapper">
                <p class="form-label">Subject</p>
                - {{$newsletter->subject}}
              </label>
              <h2 class="form-label">Content</h2>
            <label class="form-label-wrapper" style="background-color:lightgray; padding:10px;">
                
                {!!$newsletter->content!!}
              </label>

              <label class="form-label-wrapper">
                <p class="form-label">Users received the newsletter</p>
                - {{$newsletter->count}}
              </label>

            <a href="{{route('newsletter.send', ['newsLetter' => $newsletter->id])}}" class="btn btn-success mt-3">Send NewsLetter to subs</a>
        
        </div>
    </main>
        
</x-admin>