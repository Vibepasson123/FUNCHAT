<?php

namespace App\Http\Controllers;
use App\User;
use App\Events\groupevent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class groupChat extends Controller
{
/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


     public function groupsend(request $request)
    {


        $user=User::find(Auth::id());
        $this->save_message($request);
        event(new groupevent($request->chatmessage,$user->name));
    }
    public function save_message(request $request)
    {
        session()->put('chatmessage',$request->chatmessage);
    }
    public function getMessage()
    {
        return session('chatmessage');
    }
    public function clearchat()
    {
        session()->forget('chatmessage');
    }
}
