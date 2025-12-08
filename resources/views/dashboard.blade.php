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


        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard</h1>

            </div>
            <div class="text-sm text-gray-500">
                {{ \Carbon\Carbon::now()->format('l, F j, Y') }}
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Programs Card -->
            <div
                class="bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Total Programs</p>
                        <h3 class="text-3xl font-bold text-sky-800">{{ $programsCount }}</h3>
                        <p class="text-xs text-gray-500 mt-2">Academic programs available</p>
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

            <!-- Facilities Card -->
            <div
                class="bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Total Facilities</p>
                        <h3 class="text-3xl font-bold text-teal-500">{{ $facilitiesCount }}</h3>
                        <p class="text-xs text-gray-500 mt-2">Campus facilities & resources</p>
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

            <!-- Events Card -->
            <div
                class="bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Total Events</p>
                        <h3 class="text-3xl font-bold text-amber-500">{{ $eventsCount }}</h3>
                        <p class="text-xs text-gray-500 mt-2">Events & news</p>
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
        </div>

        <!-- Recent Activity Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Programs -->
            <div class="bg-white rounded-xl shadow-md border border-gray-200">
                <div class="border-b border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-800">Recent Programs</h2>
                    <p class="text-sm text-gray-600 mt-1">Latest academic programs added</p>
                </div>
                <div class="p-6">
                    @if ($recentPrograms->count() > 0)
                        <div class="space-y-4">
                            @foreach ($recentPrograms as $program)
                                <div
                                    class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $program->name }}</h4>
                                            <p class="text-sm text-gray-500">
                                                {{ $program->degree ?: 'No degree specified' }}</p>
                                        </div>
                                    </div>
                                    <span class="text-xs text-gray-400">{{ $program->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                            <p class="text-gray-500">No programs available</p>
                        </div>
                    @endif
                    <div class="mt-6">
                        <a href="{{ route('programs.index') }}"
                            class="block text-center w-full py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                            View All Programs
                        </a>
                    </div>
                </div>
            </div>

            <!-- Upcoming Events -->
            <!-- Upcoming Events -->
            <div class="bg-white rounded-xl shadow-md border border-gray-200">
                <div class="border-b border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-800">Recent Events</h2>
                    <p class="text-sm text-gray-600 mt-1">Latest events with news</p>
                </div>
                <div class="p-6">
                    @if ($recentEvents->count() > 0)
                        <div class="space-y-4">
                            @foreach ($recentEvents as $event)
                                <div
                                    class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="flex items-center space-x-3 flex-1 min-w-0">
                                        <!-- Thumbnail -->
                                        <div class="flex-shrink-0">
                                            @if ($event->thumbnail)
                                                <img src="{{ asset('storage/' . $event->thumbnail) }}"
                                                    alt="{{ $event->title }}"
                                                    class="w-12 h-12 rounded-lg object-cover border border-gray-200">
                                            @else
                                                <div
                                                    class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center border border-amber-200">
                                                    <svg class="w-6 h-6 text-amber-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Event Info -->
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-medium text-gray-900 truncate">{{ $event->title }}</h4>
                                            <div class="flex items-center space-x-3 mt-1">
                                                <!-- News Count Badge -->
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-500">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                                        </path>
                                                    </svg>
                                                    {{ $event->news_count }} news
                                                </span>

                                                <!-- Date if available -->
                                                @if ($event->date)
                                                    <span class="text-xs text-gray-500">
                                                        {{ \Carbon\Carbon::parse($event->date)->format('M j') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- View Link -->
                                    <a href="{{ route('events.show', $event) }}"
                                        class="ml-3 text-amber-500 hover:text-amber-600 flex-shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="text-gray-500">No events available</p>
                        </div>
                    @endif
                    <div class="mt-6">
                        <a href="{{ route('events.index') }}"
                            class="block text-center w-full py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                            View All Events
                        </a>
                    </div>
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
