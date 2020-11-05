<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Event;

class Attendance extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Dashboard()
    {
        $data = Event::all();
        return response()->json($data, 200);
    }
    public function detailEvent($id)
    {
        $data = Event::find($id);
        return response()->json($data, 200);
    }
    public function register(Request $request)
    {
        $event = Event::where('event_code',$request->input('event_code'))->firstOrFail();
        $event->attendance()->sync(Auth::user()->id);


        return response()->json($event, 200);
    }
}
