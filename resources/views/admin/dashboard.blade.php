<x-admin>

 
    <!-- ! Main -->
    <main class="main users chart-page" id="skip-target">
      <div class="container">
        <h2 class="main-title">Welcome {{auth()->user()->name}}!</h2>
        <div class="row stat-cards">
          <div class="col-md-6 col-xl-3">
            <a href="{{route('admin.users.index')}}">
            <article class="stat-cards-item">
              <div class="stat-cards-icon primary">
                <i data-feather="bar-chart-2" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num">{{$users}}</p>
                <p class="stat-cards-info__title">Total users</p>
              </div>
            </article>
          </a>
          </div>
          <div class="col-md-6 col-xl-3">
            <a href="{{route('post.index.admin')}}">
            <article class="stat-cards-item">
              <div class="stat-cards-icon primary">
                <i data-feather="file" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num">{{$posts}}</p>
                <p class="stat-cards-info__title">Total posts</p>
              </div>
            </article>
          </a>
          </div>
          <div class="col-md-6 col-xl-3">
            <a href="{{route('comment.index.admin')}}">
            <article class="stat-cards-item">
              <div class="stat-cards-icon primary">
                <i class="fa-solid fa-comment"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num">{{$comments}}</p>
                <p class="stat-cards-info__title">Total comments</p>
              </div>
            </article>
          </a>
          </div>
         
          <div class="col-md-6 col-xl-3">
            <a href="{{route('admin.notifications')}}">
            <article class="stat-cards-item">
              <div class="stat-cards-icon warning">
                <i class="fa-solid fa-bell"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num">{{auth()->user()->notifications()->count()}}</p>
                <p class="stat-cards-info__title">Notifications</p>
              </div>
            </article>
          </a>
          </div>
        </div>
        
      </div>
    </main>
</x-admin>