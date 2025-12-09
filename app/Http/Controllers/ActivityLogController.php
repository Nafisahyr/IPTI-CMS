<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the activity logs.
     */
    public function index()
    {
        $activities = ActivityLog::with(['user', 'subject'])
            ->latest()
            ->paginate(50);

        return view('activities.index', compact('activities'));
    }

    /**
     * Display the specified activity log.
     */
    public function show(ActivityLog $activity)
    {
        $activity->load(['user', 'subject', 'causer']);

        return view('activities.show', compact('activity'));
    }

    /**
     * Remove the specified activity log.
     */
    public function destroy(ActivityLog $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')
            ->with('success', 'Activity log deleted successfully');
    }

    /**
     * Clear all activity logs.
     */
    public function clearAll()
    {
        ActivityLog::truncate();

        return redirect()->route('activities.index')
            ->with('success', 'All activity logs have been cleared');
    }

    /**
     * Get user activities.
     */
    public function userActivities($userId)
    {
        $activities = ActivityLog::with(['user', 'subject'])
            ->where('user_id', $userId)
            ->latest()
            ->paginate(30);

        $user = \App\Models\User::findOrFail($userId);

        return view('activities.user', compact('activities', 'user'));
    }

    /**
     * Get model activities.
     */
    public function modelActivities($modelType, $modelId = null)
    {
        $query = ActivityLog::with(['user', 'subject'])
            ->where('subject_type', $modelType);

        if ($modelId) {
            $query->where('subject_id', $modelId);
        }

        $activities = $query->latest()->paginate(30);

        return view('activities.model', compact('activities', 'modelType', 'modelId'));
    }
}
