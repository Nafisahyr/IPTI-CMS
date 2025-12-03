@extends('layout')

@section('title', 'Events')

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

        @if (session('warning'))
            <div id="flash-warning" data-type="warning" data-message="{{ session('warning') }}" style="display: none;"></div>
        @endif

        @if (session('info'))
            <div id="flash-info" data-type="info" data-message="{{ session('info') }}" style="display: none;"></div>
        @endif

        <nav class="flex pb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-sky-900 dark:text-gray-400 dark:hover:text-white">
                        Events
                    </a>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Events</h1>
            </div>

            <!-- Add Event Button -->
            <button data-modal-target="addEventModal" data-modal-toggle="addEventModal"
                class="inline-flex items-center px-4 py-3 text-white font-medium rounded-lg bg-sky-700 hover:bg-sky-800 dark:bg-sky-600 dark:hover:bg-sky-700 focus:ring-4 focus:ring-sky-200 dark:focus:ring-sky-800 shadow-lg transition-all duration-200 hover:shadow-xl">
                <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Add Event
            </button>
        </div>

        <!-- Events List -->
        @if ($events->count())
            <x-table>
                <x-slot name="head">
                    <th
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        Thumbnail</th>
                    <th
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        Event Details</th>
                    <th
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        Actions</th>
                </x-slot>

                <x-slot name="body">
                    @foreach ($events as $event)
                        <tr
                            class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                            <!-- Thumbnail Column -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="{{ $event->title }}"
                                        class="w-16 h-16 object-cover rounded-lg shadow-sm border border-gray-200 dark:border-gray-600">
                                </div>
                            </td>

                            <!-- Event Details Column -->
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-gray-900 dark:text-white text-sm mb-1">
                                        {{ $event->title }}
                                    </span>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-2 leading-relaxed">
                                        {{ $event->description }}
                                    </p>
                                    @if ($event->date)
                                        <span class="text-xs text-gray-500 dark:text-gray-400 mt-2 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($event->date)->format('M j, Y') }}
                                        </span>
                                    @endif
                                    <!-- Debug info (bisa dihapus setelah testing) -->
                                    <div style="display: none;">
                                        News Count: {{ $event->news_count }},
                                        Has News: {{ $event->news_count > 0 ? 'Yes' : 'No' }}
                                    </div>
                                </div>
                            </td>

                            <!-- Actions Column -->
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <!-- View/Add News Button - KONSISTEN SEPERTI PROGRAMS -->
                                    @if ($event->news_count > 0)
                                        <!-- Jika event sudah punya news, tampilkan tombol View News -->
                                        <a href="{{ route('eventNews.show', $event->id) }}"
                                            class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 rounded-lg transition-colors dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-800 dark:hover:bg-blue-900/50">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 48 48" class="flex-shrink-0">
                                                <g fill="none" stroke="currentColor" stroke-linejoin="round"
                                                    stroke-width="3">
                                                    <rect width="36" height="36" x="6" y="6" rx="3" />
                                                    <path d="M13 13h8v8h-8z" />
                                                    <path stroke-linecap="round" d="M27 13h8m-8 7h8m-22 8h22m-22 7h22" />
                                                </g>
                                            </svg>
                                            View News
                                        </a>
                                    @else
                                        <!-- Jika event belum punya news, tampilkan tombol Add News -->
                                        <a href="{{ route('eventNews.create', $event->id) }}"
                                            class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-green-700 bg-green-50 hover:bg-green-100 border border-green-200 rounded-lg transition-colors dark:bg-green-900/30 dark:text-green-300 dark:border-green-800 dark:hover:bg-green-900/50">
                                            <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Add News
                                        </a>
                                    @endif

                                    <!-- Edit Button -->
                                    <button data-modal-target="editEventModal{{ $event->id }}"
                                        data-modal-toggle="editEventModal{{ $event->id }}"
                                        class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded-lg transition-colors dark:bg-amber-900/30 dark:text-amber-300 dark:border-amber-800 dark:hover:bg-amber-900/50">
                                        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this event?')"
                                            class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 rounded-lg transition-colors dark:bg-red-900/30 dark:text-red-300 dark:border-red-800 dark:hover:bg-red-900/50">
                                            <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
        @else
            <!-- Empty State -->
            <div
                class="text-center py-16 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="max-w-md mx-auto">
                    <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500 mb-4" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No events yet</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">Get started by creating your first event.</p>
                    
                </div>
            </div>
        @endif
    </div>

    <!-- Include Modals -->
    @include('events.create')
    @include('events.edit')

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
