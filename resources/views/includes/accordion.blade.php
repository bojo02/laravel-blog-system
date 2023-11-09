<div class="accordion" id="accordionparent">
    @foreach($faqs as $index => $faq)
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-{{$index}}" aria-expanded="false" aria-controls="accordion-{{$index}}">
          {{$faq->title}}
        </button>
      </h2>
      <div id="accordion-{{$index}}" class="accordion-collapse collapse" aria-labelledby="heading-{{$index}}" data-bs-parent="#accordionparent">
        <div class="accordion-body">
            {!!$faq->content!!}
        </div>
      </div>
    </div>
    @endforeach
  </div>