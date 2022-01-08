<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['edit', 'update']);
    }

    public function index()
    {
        $users = User::latest()->paginate(12);

        return view('users.index', compact('users'));

    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $request->has('is_admin'),
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('users.index');

    }

    public function edit(User $user){
        $this->authorize('update', $user);
        
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user){

        $this->authorize('update', $user);

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($user)
            ],
            'password' => 'confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if (!is_null($request->password)){
            $user->password = Hash::make($request->password);
        }

        if(auth()->user()->is_admin){
            $user->is_admin = $request->has('is_admin');
        }

        $user->save();
        return back()->with('status', 'Se actualizó correctamente');
        
    }

    public function destroy(User $user){
        $user->delete();

        return back();
    }
}
