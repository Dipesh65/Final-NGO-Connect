<?php

namespace App\Http\Controllers\Ngo;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Prompts\Concerns\Events;

class EventController extends Controller
{
    public function events()
    {
        $events = Event::where('user_id', Auth::user()->id)->paginate(10);
        return view('ngo.events.index', compact('events'));
    }

    public function showEventDetails($id)
    {
        $event = Event::where('id', $id)->first();
        return view('ngo.events.details', compact('event'));
    }

    public function createEvent()
    {
        return view('ngo.events.create');
    }

    public function storeEvent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'type' => 'required|in:0,1',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            'cover_image_path_name' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'capacity' => 'required|string|max:255',
            'is_volunteers_required' => 'required|boolean',
        ]);

        $event = new Event($request->only([
            'title',
            'description',
            'location',
            'type',
            'start_date',
            'end_date',
            'capacity',
            'is_volunteers_required',
        ]));
        $event->user_id = Auth::user()->id;

        if ($request->hasFile('cover_image_path_name')) {
            $path = $request->file('cover_image_path_name')->store('event_images', 'public');
            $event->cover_image_path_name = $path;
        }

        $event->save();

        return redirect()->route('ngo.events')->with('success', 'Event created successfully.');
    }

    public function editEventDetails($id)
    {
        $event = Event::find($id);
        return view('ngo.events.editDetails', compact('event'));
    }

    public function updateEventDetails(Request $request, $id)
    {
        // $this->authorize('update', $event);

        $event = Event::find($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'type' => 'required|in:0,1',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            'cover_image_path_name' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'capacity' => 'required|string|max:255',
            'is_volunteers_required' => 'required|boolean',
        ]);

        // $validated = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'type' => 'required|in:0,1',
        //     'category' => 'nullable|string|max:255',
        //     'start_date' => 'required|date|before:end_date',
        //     'end_date' => 'required|date|after:start_date',
        //     'location' => 'required|string|max:255',
        //     'capacity' => 'required|integer|min:1',
        //     'requirements' => 'nullable|string',
        //     'contact_email' => 'nullable|email|max:255',
        //     'contact_phone' => 'nullable|string|max:20',
        //     'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        // if ($request->hasFile('cover_image_path_name')) {
        //     $path = $request->file('cover_image_path_name')->store('event_images', 'public');
        //     $event->cover_image_path_name = $path;
        // }

        // if ($request->hasFile('cover_image')) {
        //     // Delete old image if it exists
        //     if ($event->cover_image_path_name) {
        //         Storage::disk('public')->delete($event->cover_image_path_name);
        //     }

        //     // Store new image
        //     $path = $request->file('cover_image')->store('events', 'public');
        //     $validated['cover_image_path_name'] = $path;
        // }

        $event->update($validated);

        return redirect()->route('ngo.events', $event->id)
            ->with('success', 'Event updated successfully!');
    }

    public function deleteEvent($id)
    {
        // Find the event by ID
        $event = Event::find($id);

        if (!$event) {
            return redirect()->route('ngo.events')->with('failure', 'Error deleting event!');
        }

        // Delete the event
        $event->delete();

        return redirect()->route('ngo.events')->with('success', 'Event deleted successfully!');
    }

}
