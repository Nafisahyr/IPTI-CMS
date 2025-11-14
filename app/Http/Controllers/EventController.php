<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Tampilkan semua event.
     */
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    /**
     * Tampilkan form tambah event.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Simpan event baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'link' => 'nullable|url',
        ]);

        try {
            $imagePath = null;

            if ($request->hasFile('thumbnail')) {
                // simpan ke storage/app/public/events
                $imagePath = $request->file('thumbnail')->store('events', 'public');
            }

            Event::create([
                'title' => $request->title,
                'description' => $request->description,
                'thumbnail' => $imagePath,
                'link' => $request->link,
            ]);

            return redirect()->route('events.index')
                ->with('success', 'Event created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Tampilkan detail event.
     */
    public function show(Event $event)
    {
        return view('events.index', compact('event'));
    }

    /**
     * Tampilkan form edit event.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update data event.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'link' => 'nullable|url',
        ]);

        try {
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link,
            ];

            if ($request->hasFile('thumbnail')) {
                // hapus gambar lama kalau ada
                if ($event->thumbnail && Storage::disk('public')->exists($event->thumbnail)) {
                    Storage::disk('public')->delete($event->thumbnail);
                }

                // simpan gambar baru
                $data['thumbnail'] = $request->file('thumbnail')->store('events', 'public');
            }

            $event->update($data);

            return redirect()->route('events.index')
                ->with('success', 'Event updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Hapus event.
     */
    public function destroy(Event $event)
    {
        try {
            if ($event->thumbnail && Storage::disk('public')->exists($event->thumbnail)) {
                Storage::disk('public')->delete($event->thumbnail);
            }

            $event->delete();

            return redirect()->route('events.index')
                ->with('success', 'Event deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Endpoint API (optional)
     */
    public function apiIndex()
    {
        $events = Event::all();

        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }
}
