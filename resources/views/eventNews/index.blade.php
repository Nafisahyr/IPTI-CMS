@extends('layout')

@section('title', 'Event News')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Toast Container -->
        <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-3 w-80 max-w-full"></div>

        <!-- Flash Messages Data Elements -->
        @if (session('success'))
            <div id="flash-success" data-type="success" data-message="{{ session('success') }}" style="display: none;"></div>
        @endif

        @if (session('error'))
            <div id="flash-error" data-type="error" data-message="{{ session('error') }}" style="display: none;"></div>
        @endif

        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li>
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">
                        Dashboard
                    </a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 mx-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="{{ route('events.index') }}" class="hover:text-blue-600 transition-colors">
                        Events
                    </a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 mx-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-gray-900 font-medium">Event News</span>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-10">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Event News</h1>
                    @if(isset($event))
                        <p class="text-gray-600">
                            News for <span class="font-medium text-blue-600">{{ $event->title }}</span>
                        </p>
                    @endif
                    <p class="text-gray-500 mt-1">
                        @if(isset($event))
                            {{ $eventNews->count() }} {{ Str::plural('news item', $eventNews->count()) }} found
                        @else
                            {{ $eventNews->count() }} total {{ Str::plural('news item', $eventNews->count()) }}
                        @endif
                    </p>
                </div>
                <a href="{{ route('eventNews.create', $event->id) }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add News
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Content Header -->
            <div class="px-8 py-6 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-800">
                    @if(isset($event))
                        News for "{{ $event->title }}"
                    @else
                        All Event News
                    @endif
                </h2>
            </div>

            <!-- News List -->
            <div class="p-8">
                @if($eventNews->count() > 0)
                    <div class="space-y-6">
                        @foreach ($eventNews as $news)
                        <div class="group bg-white rounded-xl border border-gray-200 hover:border-blue-200 hover:shadow-md transition-all duration-300 overflow-hidden">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">
                                            {{ $news->title }}
                                        </h3>
                                        <div class="flex items-center gap-4 mt-2">
                                            <span class="inline-flex items-center gap-1 text-sm text-gray-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                {{ $news->publisher }}
                                            </span>
                                            @if(!isset($event))
                                            <span class="inline-flex items-center gap-1 text-sm text-gray-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ $news->event->title }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <!-- Edit Button -->
                                        <a href="{{ route('eventNews.edit', $news->id) }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-blue-200 text-blue-600 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition-all duration-200 text-sm font-medium">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('eventNews.destroy', $news->id) }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this news?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-red-200 text-red-600 rounded-lg hover:bg-red-50 hover:border-red-300 transition-all duration-200 text-sm font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Link -->
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <a href="{{ $news->link }}" target="_blank"
                                       class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium group/link">
                                        <svg class="w-5 h-5 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                        <span class="truncate">{{ $news->link }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-50 rounded-full mb-6">
                            <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9m0 0v3m0-3a2 2 0 012-2h2a2 2 0 012 2m-6 5v6m4-3H9"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">No Event News Found</h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-8">
                            There are no news items available for this event yet.
                        </p>
                        <a href="{{ route('eventNews.create', $event->id) }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add First News
                        </a>
                    </div>
                @endif
            </div>

            <!-- Footer -->
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-100">
                <div class="flex justify-between items-center">
                    <div>
                        <a href="{{ route('events.index') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Events
                        </a>
                    </div>

                    @if($eventNews->count() > 0)
                    <div>
                        @if(isset($event))
                        <!-- Delete All for specific event -->
                        <form action="{{ route('eventNews.destroyAllByEvent', $event->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete ALL news for this event? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition-all duration-200 font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete All News
                            </button>
                        </form>
                        @else
                        <!-- Delete All for all event news -->
                        <form action="{{ route('eventNews.destroyAll') }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete ALL event news? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition-all duration-200 font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete All Event News
                            </button>
                        </form>
                        @endif
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
        const bgColor = type === 'success' ? 'bg-emerald-500' : 'bg-red-500';
        const icon = type === 'success' ?
            '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' :
            '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';

        toast.className = `${bgColor} text-white p-4 rounded-lg shadow-lg flex items-center space-x-3 transform transition-all duration-300 ease-out animate-slide-in`;
        toast.innerHTML = `
            ${icon}
            <span class="flex-1 font-medium">${message}</span>
            <button class="text-white/80 hover:text-white transition" onclick="this.parentElement.remove()">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        `;

        toastContainer.appendChild(toast);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (toast.parentElement) {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => toast.remove(), 300);
            }
        }, 5000);
    }

    // Add CSS animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slide-in {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .animate-slide-in {
            animation: slide-in 0.3s ease-out;
        }
    `;
    document.head.appendChild(style);

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
