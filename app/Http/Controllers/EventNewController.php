<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventNew;
use Illuminate\Http\Request;

class EventNewController extends Controller
{
    /**
     * Tampilkan semua Event News (tanpa filter event)
     */
    public function index()
    {
        $eventNews = EventNew::with('event')->latest()->get();
        return view('eventNews.index', compact('eventNews'));
    }

    /**
     * Tampilkan form tambah event news berdasarkan event
     */
    public function create($eventId)
    {
        $event = Event::findOrFail($eventId);
        return view('eventNews.create', compact('event'));
    }

    /**
     * Simpan event news baru ke database
     */
    public function store(Request $request, $eventId)
    {
        // Debug: cek data yang diterima
        // dd($request->all());

        $request->validate([
            'title.*' => 'required|string|max:255',
            'publisher.*' => 'required|string|max:255',
            'link.*' => 'nullable|url',
        ]);

        try {
            $eventNewsData = [];
            $count = 0;

            foreach ($request->title as $index => $title) {
                // Skip jika title kosong
                if (empty(trim($title))) {
                    continue;
                }

                $eventNewsData[] = [
                    'event_id'  => $eventId,
                    'title'     => $title,
                    'publisher' => $request->publisher[$index] ?? '',
                    'link'      => $request->link[$index] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $count++;
            }

            // Insert semua data sekaligus
            if (!empty($eventNewsData)) {
                EventNew::insert($eventNewsData);
            }

            // Redirect ke index dengan event ID
            return redirect()->route('eventNews.index', ['event' => $eventId])
                ->with('success', $count . ' event news created successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Tampilkan seluruh news milik 1 event
     * DIPERBARUI: Menggunakan view index dengan parameter event
     */
    public function show($eventId)
    {
        $event = Event::findOrFail($eventId);
        $eventNews = EventNew::where('event_id', $eventId)->with('event')->latest()->get();

        return view('eventNews.index', compact('event', 'eventNews'));
    }

    /**
     * Tampilkan form edit event news
     */
    public function edit($eventNewId)
    {
        $eventNew = EventNew::with('event')->findOrFail($eventNewId);
        return view('eventNews.edit', compact('eventNew'));
    }

    /**
     * Update event news
     */
    public function update(Request $request, $eventNewId)
    {
        $eventNew = EventNew::findOrFail($eventNewId);

        $request->validate([
            'title' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'link' => 'nullable|url',
        ]);

        try {
            $eventNew->update([
                'title' => $request->title,
                'publisher' => $request->publisher,
                'link' => $request->link,
            ]);

            return redirect()->route('eventNews.show', $eventNew->event_id)
                ->with('success', 'Event News updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Hapus event news
     */
    public function destroy($eventNewId)
    {
        try {
            $eventNew = EventNew::findOrFail($eventNewId);
            $eventId = $eventNew->event_id;
            $eventNew->delete();

            return redirect()->route('eventNews.show', $eventId)
                ->with('success', 'Event News deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Hapus semua event news
     */
    public function destroyAll()
    {
        try {
            $count = EventNew::count();
            EventNew::truncate();

            return redirect()->route('eventNews.index')
                ->with('success', "All {$count} event news deleted successfully!");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Hapus semua news untuk event tertentu
     */
    public function destroyAllByEvent($eventId)
    {
        try {
            $count = EventNew::where('event_id', $eventId)->count();
            EventNew::where('event_id', $eventId)->delete();

            return redirect()->route('eventNews.show', $eventId)
                ->with('success', "All {$count} event news for this event deleted successfully!");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Simpan multiple news untuk event yang sama (dari form edit)
     */
    public function storeMultiple(Request $request, $eventId)
    {
        $request->validate([
            'title.*' => 'required|string|max:255',
            'publisher.*' => 'required|string|max:255',
            'link.*' => 'nullable|url',
        ]);

        try {
            $eventNewsData = [];
            $count = 0;

            foreach ($request->title as $index => $title) {
                if (empty(trim($title))) {
                    continue;
                }

                $eventNewsData[] = [
                    'event_id'  => $eventId,
                    'title'     => $title,
                    'publisher' => $request->publisher[$index] ?? '',
                    'link'      => $request->link[$index] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $count++;
            }

            if (!empty($eventNewsData)) {
                EventNew::insert($eventNewsData);
            }

            return redirect()->route('eventNews.show', $eventId)
                ->with('success', $count . ' additional news created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }
}
