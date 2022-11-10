<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function store(Request $req)
    {
        $attributes=$req->validate([
            'body'=>'required',

        ]);
        $attributes['sender_id']=auth()->user()->id;
        $attributes['receiver_id']=$req->receiver_id;
        Message::create($attributes);
        return back();


    }
    public function ajax(User $user,$last_message)
    {
    $current_user=$user;
    $users=User::where('name','!=',auth()->user()->name)->latest()->get();

    $messages=Message::where(fn($query)=>

    $query
    ->where('sender_id', '=', auth()->user()->id)
    ->where('receiver_id', '=', $current_user->id)
    ->where('id','>',$last_message)

  )->orWhere(fn($query)=>

  $query
  ->where('receiver_id', '=', auth()->user()->id)
  ->where('sender_id', '=', $current_user->id)
  ->where('id','>',$last_message)

   )->oldest()->get();




    return $messages->toJson();


    }
}
