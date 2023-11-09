 <!-- ! Sidebar -->
 <aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="{{route('admin.dashboard')}}" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text">
                    <span class="logo-title">{{auth()->user()->name}}</span>
                    <span class="logo-subtitle">Dashboard</span>
                </div>

            </a>
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
                <span class="icon menu-toggle" aria-hidden="true"></span>
            </button>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                  <a class="" href="{{route('home')}}"><span class="icon" aria-hidden="true"><i class="fa-solid fa-globe"></i></span>Return to the website</a>
                </li>
                <li>
                    <a class="" href="{{route('admin.dashboard')}}"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon document" aria-hidden="true"></span>Posts
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="{{route('post.index.admin')}}">All Posts</a>
                        </li>
                        <li>
                            <a href="{{route('post.create')}}">Add new post</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon folder" aria-hidden="true"></span>Categories
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="{{route('admin.categories.index')}}">All categories</a>
                        </li>
                        <li>
                          <a href="{{route('admin.category.create')}}">Create Category</a>
                      </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon image" aria-hidden="true"></span>Slides
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="{{route('admin.slides')}}">All slides</a>
                        </li>
                        <li>
                            <a href="{{route('slide.create')}}">Create Slide</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon paper" aria-hidden="true"></span>Notifications
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="{{route('admin.notifications')}}">All Notifications</a>
                        </li>
                        <li>
                            <a href="{{route('notification.create')}}">Add new page</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('comment.index.admin')}}">
                        <span class="icon message" aria-hidden="true"></span>
                        Comments
                    </a>
                    
                </li>
                <li>
                    <a href="{{route('admin.subs')}}"><span class="icon edit" aria-hidden="true"></span>Subscribed users</a>
                </li>
            </ul>
            <span class="system-menu__title">system</span>
            <ul class="sidebar-body-menu">
                
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon category" aria-hidden="true"></span>FAQ
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="{{route('admin.faqs')}}">All Faq's<script src=""></script></a>
                        </li>
                        <li>
                            <a href="{{route('faq.create')}}">Create FAQ</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon user-3" aria-hidden="true"></span>Users
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="{{route('admin.users.index')}}">All Users</a>
                        </li>
                        <li>
                            <a href="{{route('user.admin.register')}}">Create a User</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a style="margin-left:10px;" class="show-cat-btn" href="##">
                        <span class="icon fa-solid fa-paper-plane" aria-hidden="true"></span>NewsLetters
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="{{route('admin.newsletters')}}">All NewsLetters</a>
                        </li>
                        <li>
                            <a href="{{route('newsletter.create')}}">Create a NewsLetter</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('user.admin.edit',['user' => auth()->user()->id])}}"><span class="icon setting" aria-hidden="true"></span>Profile</a>
                </li>
            </ul>
        </div>
    </div>

</aside>
  <div class="main-wrapper">
    <!-- ! Main nav -->
    <nav class="main-nav--bg">
  <div class="container main-nav">
    <div class="main-nav-start">
 
    </div>
    <div class="main-nav-end">
      <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
        <span class="sr-only">Toggle menu</span>
        <span class="icon menu-toggle--gray" aria-hidden="true"></span>
      </button>
      <!--<button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
        <span class="sr-only">Switch theme</span>
        <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
        <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
      </button> -->
      <div class="notification-wrapper">
        <button class="gray-circle-btn dropdown-btn" title="To messages" type="button">
          <span class="sr-only">To messages</span>
          <span class="icon notification @if(count(auth()->user()->notifications()) > 0) active @endif" aria-hidden="true"></span>
        </button>
        <ul class="users-item-dropdown notification-dropdown dropdown">
          @if(count(auth()->user()->notifications()) == 0) 
          <li class="center">Everything is checked!</li>
          @endif
          @foreach (auth()->user()->notifications() as $notification)
          <li>
            <a href="{{route('notification.edit', ['notification' => $notification->id])}}">
              <div class="notification-dropdown-icon info">
                <i data-feather="check"></i>
              </div>
              <div class="notification-dropdown-text">
                <span class="notification-dropdown__title">{{$notification->title}}</span>
                <span class="notification-dropdown__subtitle">{!! mb_substr($notification->content, 0, 30)!!}...</span>
              </div>
            </a>
          </li>
          @endforeach
         

            <a class="link-to-page" href="{{route('admin.notifications')}}">Go to Notifications page</a>
          </li>
        </ul>
      </div>
      <div class="nav-user-wrapper">
        <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
          <span class="sr-only">My profile</span>
          <span class="nav-user-img">
            <picture><source srcset="{{asset(auth()->user()->avatar_path)}}" type="image/webp"><img src="{{asset(auth()->user()->avatar_path)}}" alt="User name"></picture>
          </span>
        </button>
        <ul class="users-item-dropdown nav-user-dropdown dropdown">
          <li><a href="{{route('user.admin.edit',['user' => auth()->user()->id])}}">
              <i data-feather="user" aria-hidden="true"></i>
              <span>Profile</span>
            </a></li>
          <li><a class="danger" href="{{route('user.logout')}}">
              <i data-feather="log-out" aria-hidden="true"></i>
              <span>Log out</span>
            </a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>