@if(count($slides) > 0)
<div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
      @foreach($slides as $index => $slide)
      @if ($loop->first)
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      @else
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$index}}" aria-label="Slide {{$index}}"></button>
      @endif
      @endforeach
    </div>
    <div class="carousel-inner">
    @foreach($slides as $slide)
        @if ($loop->first)
          <div class="carousel-item active">
            <img src="{{asset($slide->image->image_path)}}" class="d-block w-100 image--carousel" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>{{$slide->title}}</h5>
              <p>{{$slide->description}}</p>
            </div>
          </div>
        @else
        <div class="carousel-item">
          <img src="{{asset($slide->image->image_path)}}" class="d-block w-100 image--carousel" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>{{$slide->title}}</h5>
            <p>{{$slide->description}}</p>
          </div>
        </div>
        @endif
      @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  @endif