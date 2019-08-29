<?php

namespace App\Http\Controllers;

use App\Facades\CounterFacade;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUser;
use App\Image;

// Controlle and Policy - relationship
// [
//     'show' => 'view',
//     'create' => 'create',
//     'store' => 'create',
//     'edit' => 'update',
//     'update' => 'update',
//     'destroy' => 'delete',
// ]
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::with('image')->withCount('commentsOn')->paginate(15),
            'meta_title' => __('Users')
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = User::with(['commentsOn', 'commentsOn.user'])->findOrFail($user->id);
        return view('users.show', [
            'user'=> $user,
            'meta_title' => $user->name,
            'counter' => CounterFacade::increment("user-{$user->id}")
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'meta_title' => __('Edit Profile')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        $validateData = $request->validated();
        $user->fill($validateData);
        
        if($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars');

            
            if($user->image) {
                $user->image->path = $path;
                $user->image->save();
            } else {
                $user->image()->save(
                    Image::make(['path'=>$path])
                );
            }
        }

        $user->save();
        $request->session()->flash('status', __('Profile was updated'));

        return redirect()->route('users.show', ['user'=>$user->id]);
    }
}
