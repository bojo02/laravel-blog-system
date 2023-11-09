<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        if(count($notifications = Notification::get()) > 0){
            $notifications = Notification::get()->toQuery()->latest()->paginate(10);
        }
        else{
            $notifications = [];
        }
        

        return view('admin.notifications.index', ['notifications' => $notifications]);
    }

    public function delete(Notification $notification){
        $notification->delete();

        return redirect(route('admin.notifications'))->with('success', 'The notification was deleted!');
    }

    public function seen(Notification $notification){
        $notification->seen = 1;
        $notification->save();

        return back()->with('success', 'The notification was set to seen!');
    }
    public function unseen(Notification $notification){
        $notification->seen = 0;
        $notification->save();

        return back()->with('success', 'The notification was set to unseen!');
    }
    public function edit(Notification $notification){
        return view('admin.notifications.edit', ['notification' => $notification]);
    }

    public function update(Notification $notification, Request $request){
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $notification->title = $request->title;
        $notification->content = $request->content;
        $notification->save();

        return back()->with('success', 'The notification was updated!');
    }

    public function create(){
        return view('admin.notifications.create');
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $notification = Notification::create([
            'title' => $request->title,
            'content' => $request->content,
            'seen' => 0
        ]);

        return redirect(route('notification.edit', ['notification' => $notification]))->with('success', 'The notification was created!');
    }
}
