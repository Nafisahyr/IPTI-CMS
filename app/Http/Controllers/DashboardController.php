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

        // Safe way to get upcoming events
        $upcomingEvents = $this->getUpcomingEvents();

        return view('dashboard', compact(
            'programsCount',
            'facilitiesCount',
            'eventsCount',
            'recentPrograms',
            'upcomingEvents'
        ));
    }

    private function getUpcomingEvents()
    {
        // Check if events table has date column
        if (Schema::hasTable('events') && Schema::hasColumn('events', 'date')) {
            return Event::where('date', '>=', now())
                ->orderBy('date')
                ->take(5)
                ->get();
        }

        // Fallback: just get latest events
        return Event::latest()->take(5)->get();
    }
}
