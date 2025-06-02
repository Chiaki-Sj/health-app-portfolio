<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('auth');
    }

    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        return view('users.profile.show')->with('user', $user);
    }

    public function edit()
    {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.profile.edit')
            ->with('user', $user);

       
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'          => 'required|min:1|max:50',
            'email'         => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            'avatar'        => 'mimes:jpg,png,jpeg,gif|max:1048',
            'introduction'  => 'max:100'
        ]);



        $user               = $this->user->findOrFail(Auth::user()->id);

        // 名前、メール、自己紹介を更新
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->introduction = $request->introduction;

        // アバター画像がアップロードされたら更新
        if ($request->avatar) {
            
            $user->avatar   = 'data:image/' . $request->avatar->extension() . ';base64,' .
                base64_encode(file_get_contents($request->avatar));
        }

        // 保存して完了！
        $user->save();

        //redirect🏠
        return redirect()->route('profile.show', Auth::user()->id);

        /*
            ACTIVITY
            Add the error directives on the Edit Profile view
            update().Update the name,email,and introduction.
            If the user uploaded an avatar,update it.
            Save.
            Redirect to Show Profile page.
            */
    }

    public function followers($id)
    {
        $user = $this->user->findOrFail($id);
        return view('users.profile.followers')->with('user', $user);
    }

    public function following($id)
{
    $user = $this->user->findOrFail($id);
    return view('users.profile.following')->with('user', $user);
}
}
