@extends('layout')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-screen-xl mx-auto p-6">
        <!-- Toast Container -->
        <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-3 w-80 max-w-full"></div>

        <!-- Flash Messages Data Elements -->
        @if (session('success'))
            <div id="flash-success" data-type="success" data-message="{{ session('success') }}" style="display: none;"></div>
        @endif

        @if (session('error'))
            <div id="flash-error" data-type="error" data-message="{{ session('error') }}" style="display: none;"></div>
        @endif

        <!-- Welcome Header Section -->
        <div class="bg-gradient-to-r from-sky-50 to-teal-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-8 mb-8 shadow-lg border border-gray-200 dark:border-gray-700">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <!-- User Info -->
                <div class="flex items-center space-x-6 mb-6 md:mb-0">
                    <!-- Avatar -->
                    <div class="relative">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-r from-sky-500 to-teal-500 flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-white dark:bg-gray-800 rounded-full p-2 shadow-md border border-gray-200 dark:border-gray-700">
                            @if(auth()->user()->hasRole('admin'))
                                <span class="flex items-center text-xs font-bold text-sky-600 dark:text-sky-400">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    ADMIN
                                </span>
                            @elseif(auth()->user()->hasRole('editor'))
                                <span class="flex items-center text-xs font-bold text-teal-600 dark:text-teal-400">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    EDITOR
                                </span>
                            @else
                                <span class="flex items-center text-xs font-bold text-amber-600 dark:text-amber-400">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    USER
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- User Details -->
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                            Welcome back, {{ auth()->user()->name }}!
                        </h1>
                        <div class="flex items-center space-x-4">
                            <p class="text-gray-600 dark:text-gray-300">
                                <span class="font-medium">Email:</span> {{ auth()->user()->email }}
                            </p>
                            <span class="text-gray-400">•</span>
                            <p class="text-gray-600 dark:text-gray-300">
                                Last login: {{ auth()->user()->last_login_at ? \Carbon\Carbon::parse(auth()->user()->last_login_at)->diffForHumans() : 'First time' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Account Created</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ auth()->user()->created_at->format('M d, Y') }}
                        </p>
                    </div>
                    <div class="text-center p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Member For</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ auth()->user()->created_at->diffInDays() }} days
                        </p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <div class="flex flex-wrap gap-3">
                    @if(auth()->user()->can('create-program'))
                        <a href="{{ route('programs.create') }}" class="inline-flex items-center px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-lg font-medium transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add New Program
                        </a>
                    @endif

                    @if(auth()->user()->can('create-event'))
                        <a href="{{ route('events.create') }}" class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg font-medium transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add New Event
                        </a>
                    @endif

                    @if(auth()->user()->can('create-facility'))
                        <a href="{{ route('facilities.create') }}" class="inline-flex items-center px-4 py-2 bg-teal-500 hover:bg-teal-600 text-white rounded-lg font-medium transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add New Facility
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Statistics Cards (Your existing cards remain here) -->
       {{-- Di bagian statistics cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Programs Card -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Programs</p>
                <h3 class="text-3xl font-bold text-sky-800">{{ $programsCount }}</h3>
                <p class="text-xs text-gray-500 mt-2">Academic programs</p>
            </div>
            <div class="p-3 bg-sky-50 rounded-lg">
                <svg class="w-8 h-8 text-sky-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('programs.index') }}"
                class="inline-flex items-center text-sm text-sky-800 hover:text-sky-950 font-medium">
                View all programs
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Events Card -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Events</p>
                <h3 class="text-3xl font-bold text-amber-500">{{ $eventsCount }}</h3>
                <p class="text-xs text-gray-500 mt-2">Events with news</p>
            </div>
            <div class="p-3 bg-amber-50 rounded-lg">
                <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('events.index') }}"
                class="inline-flex items-center text-sm text-amber-500 hover:text-amber-600 font-medium">
                View all events
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Facilities Card -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Facilities</p>
                <h3 class="text-3xl font-bold text-teal-500">{{ $facilitiesCount }}</h3>
                <p class="text-xs text-gray-500 mt-2">Campus facilities</p>
            </div>
            <div class="p-3 bg-teal-50 rounded-lg">
                <svg class="w-8 h-8 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('facilities.index') }}"
                class="inline-flex items-center text-sm text-teal-500 hover:text-teal-600 font-medium">
                View all facilities
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Banners Card -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Banners</p>
                <h3 class="text-3xl font-bold text-purple-500">{{ $bannersCount }}</h3>
                <p class="text-xs text-gray-500 mt-2">Homepage banners</p>
            </div>
            <div class="p-3 bg-purple-50 rounded-lg">
                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('banners.index') }}"
                class="inline-flex items-center text-sm text-purple-500 hover:text-purple-600 font-medium">
                View all banners
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</div>

        <!-- Recent Activity Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Recent Programs -->
            <div class="lg:col-span-1 bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700">
                <div class="border-b border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Recent Programs</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Latest academic programs added</p>
                </div>
                <div class="p-6">
                    <!-- ... your existing recent programs content ... -->
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="lg:col-span-1 bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700">
                <div class="border-b border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Recent Events</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Latest events with news</p>
                </div>
                <div class="p-6">
                    <!-- ... your existing recent events content ... -->
                </div>
            </div>

            <!-- Recent Activity Log -->
            <div class="lg:col-span-1 bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700">
                <div class="border-b border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Recent Activity</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Latest system activities</p>
                </div>
                <div class="p-6">
                    @if($recentActivities->count() > 0)
                        <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2">
                            @foreach($recentActivities as $activity)
                                <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <!-- Avatar -->
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-r
                                            @if($activity->user->hasRole('admin')) from-sky-400 to-sky-600
                                            @elseif($activity->user->hasRole('editor')) from-teal-400 to-teal-600
                                            @else from-gray-400 to-gray-600 @endif
                                            flex items-center justify-center text-white text-sm font-bold">
                                            {{ strtoupper(substr($activity->user->name, 0, 1)) }}
                                        </div>
                                    </div>

                                    <!-- Activity Details -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between">
                                            <p class="font-medium text-gray-900 dark:text-white">
                                                {{ $activity->user->name }}
                                            </p>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $activity->created_at->diffForHumans() }}
                                            </span>
                                        </div>

                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                            {{ $activity->description }}
                                        </p>

                                        @if($activity->subject_type && $activity->subject_id)
                                            <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    @if($activity->subject_type == 'App\\Models\\Program')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                    @elseif($activity->subject_type == 'App\\Models\\Event')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    @elseif($activity->subject_type == 'App\\Models\\Facility')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    @endif
                                                </svg>
                                                <span class="capitalize">{{ str_replace('App\\Models\\', '', $activity->subject_type) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400">No activities found</p>
                        </div>
                    @endif

                    @if($recentActivities->count() > 0)
                        <div class="mt-6">
                            <a href="{{ route('activities.index') }}" class="block text-center w-full py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors font-medium">
                                View All Activities
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toast notification system
            function showToast(message, type = 'success') {
                const toastContainer = document.getElementById('toast-container');
                const toast = document.createElement('div');
                const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
                const icon = type === 'success' ?
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' :
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';

                toast.className =
                    `${bgColor} text-white p-4 rounded-lg shadow-lg flex items-center space-x-3 transform transition-transform duration-300 ease-in-out`;
                toast.innerHTML = `
                    ${icon}
                    <span class="flex-1">${message}</span>
                    <button class="text-white hover:text-gray-200 transition" onclick="this.parentElement.remove()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                `;

                toastContainer.appendChild(toast);

                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.remove();
                    }
                }, 5000);
            }

            // Show flash messages
            const flashSuccess = document.getElementById('flash-success');
            const flashError = document.getElementById('flash-error');

            if (flashSuccess) {
                showToast(flashSuccess.dataset.message, 'success');
            }

            if (flashError) {
                showToast(flashError.dataset.message, 'error');
            }
        });
    </script>
@endsection
