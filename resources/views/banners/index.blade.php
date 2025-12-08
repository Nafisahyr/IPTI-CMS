@extends('layout')

@section('title', 'Banners')

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
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Banners</h1>
            </div>

            <!-- Add Banner Button -->
            @can('add-banner')
                <button data-modal-target="addBannerModal" data-modal-toggle="addBannerModal"
                    class="inline-flex items-center px-4 py-3 text-white font-medium rounded-lg bg-sky-700 hover:bg-sky-800 dark:bg-sky-600 dark:hover:bg-sky-700 focus:ring-4 focus:ring-sky-200 dark:focus:ring-sky-800 shadow-lg transition-all duration-200 hover:shadow-xl">
                    <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                    Add Banner
                </button>
            @else
                <!-- Disabled Button with Tooltip -->
                <div class="relative group">
                    <button disabled
                        class="inline-flex items-center px-4 py-3 text-gray-400 font-medium rounded-lg bg-gray-100 dark:bg-gray-700 cursor-not-allowed shadow-sm">
                        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                            </path>
                        </svg>
                        Add Banner
                        <svg class="w-4 h-4 ms-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                    <!-- Tooltip -->
                    <div class="absolute z-10 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 top-full left-1/2 transform -translate-x-1/2 mt-2 px-3 py-2 text-xs font-medium text-white bg-gray-900 rounded-lg shadow-sm dark:bg-gray-700">
                        <span class="flex items-center">
                            You don't have permission to add banners
                        </span>
                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-900 dark:border-t-gray-700"></div>
                    </div>
                </div>
            @endcan
        </div>

        <!-- Banners List -->
        @if ($banners->count())
            <x-table>
                <x-slot name="head">
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        Image</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        Actions</th>
                </x-slot>

                <x-slot name="body">
                    @foreach ($banners as $banner)
                        <tr class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                            <!-- Image Column -->
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner Image"
                                        class="w-20 h-20 object-cover rounded-lg shadow-sm border border-gray-200 dark:border-gray-600">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                            {{ $banner->name ?? 'Banner Image' }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            Uploaded: {{ $banner->created_at->format('M j, Y') }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <!-- Actions Column -->
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <!-- Edit Button -->
                                    @can('update-banner')
                                        <button data-modal-target="editBannerModal{{ $banner->id }}"
                                            data-modal-toggle="editBannerModal{{ $banner->id }}"
                                            class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded-lg transition-colors dark:bg-amber-900/30 dark:text-amber-300 dark:border-amber-800 dark:hover:bg-amber-900/50">
                                            <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                            Edit
                                        </button>
                                    @else
                                        <!-- Disabled Edit Button with Tooltip -->
                                        <div class="relative group">
                                            <button disabled
                                                class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:text-gray-500 dark:border-gray-600">
                                                <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                                Edit
                                            </button>
                                            <!-- Tooltip -->
                                            <div class="absolute z-10 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 bottom-full left-0 mb-2 px-3 py-2 text-xs font-medium text-white bg-gray-900 rounded-lg shadow-sm dark:bg-gray-700 w-48">
                                                <span class="flex items-center">
                                                    You don't have permission to edit banners
                                                </span>
                                                <div class="absolute top-full left-4 transform border-4 border-transparent border-t-gray-900 dark:border-t-gray-700"></div>
                                            </div>
                                        </div>
                                    @endcan

                                    <!-- Delete Button -->
                                    @can('delete-banner')
                                        <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this banner?')"
                                                class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 rounded-lg transition-colors dark:bg-red-900/30 dark:text-red-300 dark:border-red-800 dark:hover:bg-red-900/50">
                                                Delete
                                            </button>
                                        </form>
                                    @else
                                        <!-- Disabled Delete Button with Tooltip -->
                                        <div class="relative group">
                                            <button disabled
                                                class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:text-gray-500 dark:border-gray-600">
                                                <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                                Delete
                                            </button>
                                            <!-- Tooltip -->
                                            <div class="absolute z-10 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 bottom-full left-0 mb-2 px-3 py-2 text-xs font-medium text-white bg-gray-900 rounded-lg shadow-sm dark:bg-gray-700 w-52">
                                                <span class="flex items-center">
                                                    You don't have permission to delete banners
                                                </span>
                                                <div class="absolute top-full left-4 transform border-4 border-transparent border-t-gray-900 dark:border-t-gray-700"></div>
                                            </div>
                                        </div>
                                    @endcan

                                    <!-- View Button (always enabled) -->
                                    <a href="{{ asset('storage/' . $banner->image) }}" target="_blank"
                                        class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 rounded-lg transition-colors dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-800 dark:hover:bg-blue-900/50">
                                        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
        @else
            <!-- Empty State -->
            <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="max-w-md mx-auto">
                    <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No banners yet</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">Get started by adding your first banner image.</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Include Modals (only if user has permission) -->
    @can('add-banner')
        @include('banners.create')
    @endcan

    @can('update-banner')
        @if (isset($banners) && $banners->count())
            @include('banners.edit')
        @endif
    @endcan

    <style>
        /* Existing styles */
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

        /* New styles for disabled buttons */
        .disabled-button {
            position: relative;
        }

        .disabled-button:hover::after {
            content: "You don't have permission to access this feature";
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #374151;
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            white-space: nowrap;
            z-index: 50;
            margin-bottom: 0.5rem;
        }

        .disabled-button:hover::before {
            content: "";
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            border-width: 6px;
            border-style: solid;
            border-color: #374151 transparent transparent transparent;
            margin-bottom: -0.25rem;
            z-index: 50;
        }
    </style>

    <script>
        // Toast configuration (existing)
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
            }
        };

        function showToast(type, message) {
            // ... existing toast code ...
        }

        function removeToast(toastId) {
            // ... existing toast code ...
        }

        // Handle flash messages on page load
        document.addEventListener('DOMContentLoaded', function() {
            const flashTypes = ['success', 'error', 'warning', 'info'];

            flashTypes.forEach(type => {
                const element = document.getElementById(`flash-${type}`);
                if (element) {
                    showToast(type, element.dataset.message);
                    element.remove();
                }
            });

            // Disable modal opening for users without permission
            document.querySelectorAll('[data-modal-target]').forEach(button => {
                if (button.disabled) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        showToast('error', 'You do not have permission to access this feature');
                    });
                }
            });
        });
    </script>
@endsection
