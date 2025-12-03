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

        @if (session('warning'))
            <div id="flash-warning" data-type="warning" data-message="{{ session('warning') }}" style="display: none;">
            </div>
        @endif

        @if (session('info'))
            <div id="flash-info" data-type="info" data-message="{{ session('info') }}" style="display: none;"></div>
        @endif


        <!-- Breadcrumb -->
        <nav class="flex pb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('events.index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        Events
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('eventNews.index') }}"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600">
                            Event News
                        </a>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-10">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Event News</h1>
                    @if (isset($event) && $event)
                        <p class="text-gray-600">
                            News for <span class="font-medium text-blue-600">{{ $event->title }}</span>
                        </p>
                    @else
                        <p class="text-gray-600">All event news articles</p>
                    @endif
                    <p class="text-gray-500 mt-1">
                        {{ $eventNews->count() }} {{ Str::plural('news item', $eventNews->count()) }} found
                    </p>
                </div>
                @if (isset($event) && $event)
                    <a href="{{ route('eventNews.create', $event->id) }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add News
                    </a>
                @else
                    <div class="text-sm text-gray-500">
                        Select an event to add news
                    </div>
                @endif
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Content Header -->
            <div class="px-8 py-6 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-800">
                    @if (isset($event) && $event)
                        News for "{{ $event->title }}"
                    @else
                        All Event News
                    @endif
                </h2>
            </div>

            <!-- News List -->
            <div class="p-8">
                @if ($eventNews->count() > 0)
                    <div class="space-y-6">
                        @foreach ($eventNews as $news)
                            <div
                                class="group bg-white rounded-xl border border-gray-200 hover:border-blue-200 hover:shadow-md transition-all duration-300 overflow-hidden">
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex-1">
                                            <h3
                                                class="text-lg font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">
                                                {{ $news->title }}
                                            </h3>
                                            <div class="flex items-center gap-4 mt-2">
                                                <span class="inline-flex items-center gap-1 text-sm text-gray-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                    {{ $news->publisher }}
                                                </span>
                                                @if (!isset($event) || !$event)
                                                    <span class="inline-flex items-center gap-1 text-sm text-gray-600">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        {{ $news->event->title ?? 'No Event' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <!-- Edit Button -->
                                            <a href="{{ route('eventNews.edit', $news->id) }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-blue-200 text-blue-600 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition-all duration-200 text-sm font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
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
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Link -->
                                    @if ($news->link)
                                        <div class="mt-4 pt-4 border-t border-gray-100">
                                            <a href="{{ $news->link }}" target="_blank"
                                                class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium group/link">
                                                <svg class="w-5 h-5 group-hover/link:translate-x-1 transition-transform"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                                <span class="truncate">{{ $news->link }}</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-50 rounded-full mb-6">
                            <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9m0 0v3m0-3a2 2 0 012-2h2a2 2 0 012 2m-6 5v6m4-3H9" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">No Event News Found</h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-8">
                            @if (isset($event) && $event)
                                There are no news items available for this event yet.
                            @else
                                There are no news items available yet.
                            @endif
                        </p>
                        @if (isset($event) && $event)
                            <a href="{{ route('eventNews.create', $event->id) }}"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add First News
                            </a>
                        @endif
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Events
                        </a>
                    </div>

                    @if ($eventNews->count() > 0)
                        <div>
                            @if (isset($event) && $event)
                                <!-- Delete All for specific event -->
                                <form action="{{ route('eventNews.destroyAllByEvent', $event->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete ALL news for this event? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 px-5 py-2.5 text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition-all duration-200 font-medium">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .toast {
            animation: slideIn 0.3s ease-out forwards;
            transform: translateX(100%);
            opacity: 0;
        }

        .toast.hiding {
            animation: slideOut 0.3s ease-in forwards;
        }

        @keyframes slideIn {
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .progress-bar {
            animation: shrink 5s linear forwards;
        }

        @keyframes shrink {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }
    </style>

    <script>
        // Toast configuration
        const toastTypes = {
            success: {
                bg: 'bg-green-500',
                icon: `
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
            `,
                iconBg: 'bg-green-100 dark:bg-green-800',
                iconColor: 'text-green-500 dark:text-green-200'
            },
            error: {
                bg: 'bg-red-500',
                icon: `
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
            `,
                iconBg: 'bg-red-100 dark:bg-red-800',
                iconColor: 'text-red-500 dark:text-red-200'
            },
            warning: {
                bg: 'bg-yellow-500',
                icon: `
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                </svg>
            `,
                iconBg: 'bg-yellow-100 dark:bg-yellow-800',
                iconColor: 'text-yellow-500 dark:text-yellow-200'
            },
            info: {
                bg: 'bg-blue-500',
                icon: `
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
            `,
                iconBg: 'bg-blue-100 dark:bg-blue-800',
                iconColor: 'text-blue-500 dark:text-blue-200'
            }
        };

        function showToast(type, message) {
            const container = document.getElementById('toast-container');
            const toastId = 'toast-' + Date.now();

            const config = toastTypes[type];

            const toast = document.createElement('div');
            toast.id = toastId;
            toast.className =
                `toast flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800`;

            toast.innerHTML = `
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 ${config.iconBg} ${config.iconColor} rounded-lg">
                ${config.icon}
                <span class="sr-only">${type} icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">${message}</div>
            <button type="button" onclick="removeToast('${toastId}')" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700 transition-colors">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
            <div class="absolute bottom-0 left-0 h-1 ${config.bg} progress-bar rounded-b-lg"></div>
        `;

            container.appendChild(toast);

            // Trigger animation
            setTimeout(() => {
                toast.style.transform = 'translateX(0)';
                toast.style.opacity = '1';
            }, 10);

            // Auto remove setelah 5 detik
            setTimeout(() => {
                removeToast(toastId);
            }, 5000);
        }

        function removeToast(toastId) {
            const toast = document.getElementById(toastId);
            if (toast) {
                toast.classList.add('hiding');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }
        }

        // Handle flash messages on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Handle semua jenis flash messages
            const flashTypes = ['success', 'error', 'warning', 'info'];

            flashTypes.forEach(type => {
                const element = document.getElementById(`flash-${type}`);
                if (element) {
                    showToast(type, element.dataset.message);
                    element.remove();
                }
            });
        });
    </script>
@endsection
