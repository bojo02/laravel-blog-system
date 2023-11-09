<x-admin>
    <div class="container mt-5">
        <h2 class="main-title">Notifications</h2>

        <div class="elements mt-5">
            @if(!isset($notifications))
            
            @else
                @foreach ($notifications as $notification)
                <div class="card mt-3">
                    <div class="card-body clear">
                    <span class="text">
                        {{$notification->title}}
                    </span>
                    <span class="actions">
                        
                        <form action="{{route('notification.delete', [$notification->id])}}" method="POST">
                            @CSRF
                            @method('delete')
                            @if($notification->seen == 0)
                                <a href="{{route('notification.seen', ['notification' => $notification->id])}}" class="btn btn-outline-success">Mark Seen</a>
                            @else
                            <a href="{{route('notification.unseen', ['notification' => $notification->id])}}" class="btn btn-outline-secondary">Mark Unseen</a>
                            @endif
                            <a href="{{route('notification.edit', ['notification' => $notification->id])}}" class="btn btn-outline-dark">Edit</a>
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </span>
                    </div>
                </div>
                @endforeach
                @if(count($notifications) > 0)
                    <div class="mt-5">
                        {{$notifications->links()}}
                    </div>
                @else
                <p>There aren't any notifications yet</p>
                @endif
            @endif
          
        </div>
    </div>
</x-admin>