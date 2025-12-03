<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Facility;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $programsCount = Program::count();
        $facilitiesCount = Facility::count();
        $eventsCount = Event::count();

        $recentPrograms = Program::latest()->take(5)->get();

        // Load events with their news count and eager load thumbnail
        $recentEvents = $this->getRecentEvents();

        return view('dashboard', compact(
            'programsCount',
            'facilitiesCount',
            'eventsCount',
            'recentPrograms',
            'recentEvents'
        ));
    }

    private function getRecentEvents()
    {
        // Check if events table exists
        if (!Schema::hasTable('events')) {
            return collect(); // Return empty collection
        }

        // Load events with news count
        $events = Event::withCount('news')
            ->latest()
            ->take(5)
            ->get();

        return $events;
    }
}
