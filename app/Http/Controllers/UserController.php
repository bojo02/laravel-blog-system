<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function loginPage(){
        return view('user.login');
    }
    public function login(Request $request){
        $incomingFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(auth()->attempt($incomingFields)){
            $request->session()->regenerate();

            return redirect(route('home'))->with('success', 'You logged in successfully!');
        }
        else{
            return redirect()->back()->with('wrong', 'Your email / password is wrong!');
        }  
    }

    public function searchUser(Request $request){
        if(empty($request['search'])){
            return back()->with('wrong', 'You didn\'t type anything...');
        }
        if(count(User::search($request['search'])->get()) > 0){
            $users = User::search($request['search'])->get()->toQuery()->latest()->paginate(10);

            if($users->count() == 0){
                $users = [];
            }
    
            return view('admin.users.index', ['users' => $users, 'searchterm' => $request->search]);
        }
        return redirect(route('admin.users.index'))->with('wrong', 'We did not find any results...');
    }

    public function indexAdmin(){
        if(User::all()->count() > 0){
            $users = User::get()->toQuery()->latest()->paginate(10);
        }
        else{
            $users = [];
        }

        return view('admin.users.index', ['users' => $users]);
    }
    public function register(){
        return view('user.register');
    }
    public function registerAdmin(){
        return view('admin.users.register');
    }

    public function storeAdmin(Request $request){
        $incomingFields = $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = new User();

        $user->name = $incomingFields['name'];
        $user->lastname = $incomingFields['lastname'];
        $user->email = $incomingFields['email'];
        $user->password = $incomingFields['password'];
        

        if($request->has('image')){
            $request->validate([
                'image' => ['image'],
            ]);

            Storage::put('/public/avatars/', $request->file('image'));

            $user->avatar_path = "/storage/avatars/" . $request->file('image')->hashName();
        }

        if($request->has('is_admin')){
            $user->is_admin = 1;
        }

        $user->save();
        

        return redirect()->back()->with('success', 'The account has been created!');
    }
    public function store(Request $request){
        $incomingFields = $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = User::create($incomingFields);

        auth()->login($user);

        return redirect(route('home'))->with('success', 'Your account has been created!');
    }

    public function update(Request $request, User $user){
        if($user->email == $request->email){
            $incomingFields = $request->validate([
                'name' => 'required',
                'lastname' => 'required'
            ]);
        }
        else{
            $incomingFields = $request->validate([
                'name' => 'required',
                'lastname' => 'required',
                'email' => ['required', Rule::unique('users', 'email')],
            ]);

            $user->email = $request->email;
        }
        
        if($request->has('is_admin')){
            $user->is_admin = 1;
        }
        else{
            $user->is_admin = 0;
        }

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        

        if(!empty($request->password)){
            $request->validate([
                'password' => ['required', 'min:8', 'confirmed'],
            ]);

            $incomingFields['password'] = bcrypt( $request['password']);

            $user->password = $incomingFields['password'];
        }

        if($request->has('image')){
            $request->validate([
                'image' => ['image'],
            ]);

            Storage::put('/public/avatars/', $request->file('image'));

            Storage::delete(str_replace('storage', 'public', $user->avatar_path));

            $user->avatar_path = "/storage/avatars/" . $request->file('image')->hashName();
        }

        $user->save();

        return redirect()->back()->with('success', 'The account has been updated!');
    }

    public function logout(){
        auth()->logout();

        return redirect(route('home'))->with('success', 'You logged out successfully!');
    }

    public function destroy(User $user){
        $user->delete();

        return redirect()->back()->with('success', 'The account has been deleted!');
    }

    public function edit(User $user){
        return view('admin.users.edit', ['user' => $user]);
    }
}
