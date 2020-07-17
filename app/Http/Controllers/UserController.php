<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all('name','id', 'email', 'role', 'slug');
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $user = User::where('slug', $user)->firstOrFail();
        if($user->id === Auth::user()->id || Auth::user()->role === "admin"){
            return view('users.edit', compact('user'));
        }
        abort(401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {

        $user = User::FindOrFail($id);

        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users'
        ]);

        if($request->input('delete')){
            $user->deleteAvatar();
            Storage::delete("/images/avatars/avatar_{$user->id}.jpeg");
        }

        $user->slug = Str::slug($request->name);
        $user->name = Str::ucfirst($request->name);

        $user->update($request->only('email','avatar'));

        return redirect(action('UserController@edit', $user->slug));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user = User::FindOrFail($user);
        $user->delete();
        return redirect(action('UserController@index'));
    }
}
