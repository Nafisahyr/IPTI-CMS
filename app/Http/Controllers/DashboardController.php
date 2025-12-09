<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Event;
use App\Models\Facility;
use App\Models\Banner;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Statistics
        $programsCount = Program::count();
        $eventsCount = Event::count();
        $facilitiesCount = Facility::count();
        $bannersCount = Banner::count();

        // Recent data
        $recentPrograms = Program::with('detail')->latest()->take(5)->get();
        $recentEvents = Event::withCount('news')->latest()->take(5)->get();

        // Recent activities
        $recentActivities = ActivityLog::with(['user', 'subject'])
            ->whereNotIn('event', ['login', 'logout', 'register'])
            ->latest()
            ->take(15)
            ->get();

        return view('dashboard', compact(
            'programsCount',
            'eventsCount',
            'facilitiesCount',
            'bannersCount',
            'recentPrograms',
            'recentEvents',
            'recentActivities'
        ));
    }

    /**
     * Get dashboard statistics for AJAX requests.
     */
    public function getStats(Request $request)
    {
        $user = Auth::user();

        $stats = [
            'programs' => Program::count(),
            'events' => Event::count(),
            'facilities' => Facility::count(),
            'banners' => Banner::count(),
            'users' => \App\Models\User::count(),
            'activity_logs' => ActivityLog::count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->getRoleNames(),
                'last_login' => $user->last_login_at,
            ]
        ]);
    }

    /**
     * Get recent activities for AJAX requests.
     */
    public function getRecentActivities(Request $request)
    {
        $limit = $request->get('limit', 10);

        $activities = ActivityLog::with(['user', 'subject'])
            ->whereNotIn('event', ['login', 'logout', 'register'])
            ->latest()
            ->take($limit)
            ->get()
            ->map(function ($activity) {
                return [
                    'id' => $activity->id,
                    'description' => $activity->description,
                    'event' => $activity->event,
                    'created_at' => $activity->created_at->diffForHumans(),
                    'user' => [
                        'name' => $activity->user->name,
                        'avatar' => $activity->user->avatar_url,
                        'roles' => $activity->user->getRoleNames(),
                    ],
                    'subject_type' => class_basename($activity->subject_type),
                    'subject_id' => $activity->subject_id,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $activities
        ]);
    }

    /**
     * Get chart data for dashboard.
     */
    public function getChartData(Request $request)
    {
        $period = $request->get('period', 'month'); // day, week, month, year

        // Get activities per period
        $activities = ActivityLog::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays($this->getDaysForPeriod($period)))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Get activities by model type
        $byModel = ActivityLog::selectRaw('subject_type, COUNT(*) as count')
            ->whereNotNull('subject_type')
            ->groupBy('subject_type')
            ->get()
            ->map(function ($item) {
                return [
                    'model' => class_basename($item->subject_type),
                    'count' => $item->count
                ];
            });

        // Get activities by user
        $byUser = ActivityLog::with('user')
            ->selectRaw('user_id, COUNT(*) as count')
            ->groupBy('user_id')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get()
            ->map(function ($item) {
                return [
                    'user' => $item->user->name,
                    'count' => $item->count
                ];
            });

        return response()->json([
            'success' => true,
            'data' => [
                'activities_over_time' => $activities,
                'activities_by_model' => $byModel,
                'activities_by_user' => $byUser,
            ]
        ]);
    }

    private function getDaysForPeriod($period)
    {
        return match($period) {
            'day' => 1,
            'week' => 7,
            'month' => 30,
            'year' => 365,
            default => 30,
        };
    }
}
