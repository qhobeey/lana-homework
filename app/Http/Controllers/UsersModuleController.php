<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersModuleController extends Controller
{
    
    public function users(Request $request)
    {
        $users = User::latest()->paginate(40);
        return view('pages.users.index', compact('users'));
    }
    public function addUsers(Request $request)
    {
        return view('pages.users.add');
    }
    public function postUsers(Request $request)
    {
    
        $data = $request->validate([
            'name' => 'required', 'username' => 'required|unique:users', 'email' => 'required|unique:users',
            'password' => 'required', 'profile_pic' => '',
        ]);
        $data['password'] = Hash::make($data['password']);
        $imageName = time().'.'.$request->profile_pic->extension(); 
        $request->profile_pic->move(public_path('profiles'), $imageName);
        unset($data['profile_pic']);
        $data['profile'] = $imageName;

        User::create($data);
        return back()
            ->with('success','You have successfully added a user.');
        
    }
    public function editUsers(Request $request, $id)
    {
        $user = User::where('userid', $id)->first();
        if(!$user) {
            return back()
            ->with('danger','User not found');
        }
        return view('pages.users.edit', compact('user'));
    }
    public function updateUsers(Request $request, $id)
    {
        $user = User::where('userid', $id)->first();
        if(!$user) {
            return back()
            ->with('danger','User not found');
        }
        $data = $request->validate([
            'name' => 'required', 'username' => 'required', 'email' => 'required'
        ]);
        if($request->password) {
            $data['password'] = Hash::make($data['password']);
        }
        if($request->profile_pic) {
            $imageName = time().'.'.$request->profile_pic->extension(); 
            $request->profile_pic->move(public_path('profiles'), $imageName);
            unset($data['profile_pic']);
            $data['profile'] = $imageName;
        }

        $user->update($data);
        
        return back()
            ->with('success','You have successfully updated user.');
    }
    public function deleteUsers(Request $request, $id)
    {
        $user = User::where('userid', $id)->first();
        if(!$user) {
            return back()
            ->with('danger','User not found');
        }
        $user->delete();
        return back()
            ->with('success','You have successfully deleted user.');
    }
}
