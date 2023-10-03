<?php

namespace App\Http\Controllers\Dashboard;

use DB;
use Hash;
use App\Models\User;
use App\Models\Notification as NotificationModel;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserAdded;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('dashboard.users.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    


    public function show($id)
    {
        $user = User::find($id);
        return view('dashboard.users.show',compact('user'));
    }
    


    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('dashboard.users.create',compact('roles'));
    }
    


    public function store(Request $request)
    {
        $this->validate($request, [
            'name'       => 'required',
            'email'      => 'required|email|unique:users,email',
            'mobile'     => 'required|unique:users,mobile',
            'password'   => 'required|same:confirm-password',
            'roles_name' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles_name'));

        //send notification mail
        $user = User::where('id', Auth::user()->id)->get();
        $id = User::latest()->first()->id;
        Notification::send($user, new UserAdded($id));

        session()->flash('success');
        return redirect()->route('users.index');
    }
    


    public function edit($id)
    {
        $user     = User::find($id);
        $roles    = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('dashboard.users.edit',compact('user','roles','userRole'));
    }
    

        
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,'.$id,
            'mobile'   => 'required|unique:users,mobile,'.$id,
            'password' => 'same:confirm-password',
            'roles'    => 'required'
        ]);
        $input = $request->all();
        if(!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input,array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

        session()->flash('success');
        return redirect()->route('users.index');
    }
    


    public function destroy(Request $request)
    {
        User::find($request->user_id)->delete();

        session()->flash('success');
        return redirect()->route('users.index');
    }



    public function showNotification($id)
    {
        $notification = NotificationModel::findOrFail($id);
        $notification->update([
            'read_at' => now(),
        ]);
        $user = User::findOrFail($id);
        return view('dashboard.users.show',compact('user'));
    }
}