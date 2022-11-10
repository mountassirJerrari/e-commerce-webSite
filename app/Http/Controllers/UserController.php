<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;


class UserController extends Controller
{
    public function login(Request $request)
    {


      $user=$request->validate(
        [
          'name'=>'required',
          'password'=>'required|min:7'
        ]
      );
      if (auth()->attempt($user))
      {
         auth()->user()->online=true;
         auth()->user()->save();
          return redirect('/chatroom')->with('message','loged in successfly !');
      }
      return back()->withErrors(['error'=>'we cannot match your information.']);

    }

    public function store(Request $request)
  {

    $validated=$request->validate(
      [
        'name'=>'required|min:3|unique:users',
        'email'=>'required|email|unique:users',
        'password'=>'required|min:7'
      ]
    );
    $validated['password']=bcrypt($validated['password']);
    $validated['online']=true;
    $newUser=User::create($validated);

    auth()->login($newUser);

    return redirect('/chatroom');

  }



  public function chatroom(User $user)

  {
      $current_user=$user;
    $users=User::where('name','!=',auth()->user()->name)->latest()->get();

    $messages=Message::where(fn($query)=>

    $query
    ->where('sender_id', '=', auth()->user()->id)
    ->where('receiver_id', '=', $current_user->id)

  )->orWhere(fn($query)=>

  $query
  ->where('receiver_id', '=', auth()->user()->id)
  ->where('sender_id', '=', $current_user->id)

   )->oldest()->get();


    return view('chatroom',[
        'users'=>$users,
        'current_user'=>$current_user,
        'messages'=>$messages,
        'last_message'=>$messages->last()?->id

    ]);
  }
  public function logout()
  {
    if (auth()->check()) {
    auth()->user()->online=false;
    auth()->user()->save();
    auth()->logout();
    }
    return redirect('/')->with('message','loged out !');
  }
}
