<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Event;

class OrganizerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:organizer');
    }
    public function addEvent(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required',
            'location' => 'required',
            'time_from' => 'required',
            'time_until' =>'required',
        ]);

        $event = new Event;
        $event->name = $request->input('name');
        $event->organizer_id = auth('organizer')->user()->id;
        $event->event_code = Str::random(6);
        $event->description = $request->input('description');
        $event->location = $request->input('location');
        $event->time_until = $request->input('time_until');
        $event->time_from = $request->input('time_from');
        $event->save();

        return response()->json(['event' => $event, 'message' => 'CREATED'], 201);

    }
    public function myEvent()
    {
        $data = Event::where("organizer_id", auth('organizer')->user()->id)->get();
        return response()->json($data, 200);
    }
    public function detailEvent($id)
    {
        $data = Event::where("id",$id)->with("attendance")->firstOrFail();
        return response()->json($data, 200);
    }
    public function register(Request $request)
    {
        $event = Event::where('event_code',$request->input('event_code'))->firstOrFail();
        $event->attendance()->sync(Auth::user()->id);


        return response()->json(['data'=> 'berhasil ditambahkan'], 200);
    }
}
