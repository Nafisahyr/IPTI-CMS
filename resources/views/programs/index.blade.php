@extends('layout')

@section('title', 'Programs')

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

        <nav class="flex pb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-sky-900 dark:text-gray-400 dark:hover:text-white">
                        Programs
                    </a>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Programs</h1>
            </div>

            <!-- Add Program Button -->
            @can('add-program')
                <button data-modal-target="addProgramModal" data-modal-toggle="addProgramModal"
                    class="inline-flex items-center px-4 py-3 text-white font-medium rounded-lg bg-sky-700 hover:bg-sky-800 dark:bg-sky-600 dark:hover:bg-sky-700 focus:ring-4 focus:ring-sky-200 dark:focus:ring-sky-800 shadow-lg transition-all duration-200 hover:shadow-xl">
                    <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                    Add Program
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
                        Add Program
                        <svg class="w-4 h-4 ms-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                    <!-- Tooltip -->
                    <div class="absolute z-10 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 top-full left-1/2 transform -translate-x-1/2 mt-2 px-3 py-2 text-xs font-medium text-white bg-gray-900 rounded-lg shadow-sm dark:bg-gray-700">
                        <span class="flex items-center">
                            <svg class="w-3 h-3 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H9m3-9a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            You don't have permission to add programs
                        </span>
                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-900 dark:border-t-gray-700"></div>
                    </div>
                </div>
            @endcan
        </div>

        <!-- Programs List -->
        @if ($programs->count())
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-600">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Image
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Program
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Description
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($programs as $program)
                                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                    <!-- Image Column -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <img src="{{ asset('storage/' . $program->image) }}" alt="{{ $program->name }}"
                                                class="w-16 h-16 object-cover rounded-lg shadow-sm border border-gray-200 dark:border-gray-600">
                                        </div>
                                    </td>

                                    <!-- Program Name Column -->
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-gray-900 dark:text-white text-sm">
                                                {{ $program->name }}
                                            </span>
                                            @if ($program->code)
                                                <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                    {{ $program->code }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Description Column -->
                                    <td class="px-6 py-4 max-w-md">
                                        <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-2 leading-relaxed">
                                            {{ $program->description }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                            Added: {{ $program->created_at->format('M j, Y') }}
                                        </p>
                                    </td>

                                    <!-- Actions Column -->
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <!-- Detail/Add Detail Button -->
                                            @if ($program->detail)
                                                <!-- Jika program sudah punya detail -->
                                                @can('show-programDetail')
                                                    <a href="{{ route('programdetail.show', $program->detail->id) }}"
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
                                                        View Detail
                                                    </a>
                                                @else
                                                    <!-- Disabled View Detail Button -->
                                                    <div class="relative group">
                                                        <button disabled
                                                            class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:text-gray-500 dark:border-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                viewBox="0 0 48 48" class="flex-shrink-0">
                                                                <g fill="none" stroke="currentColor" stroke-linejoin="round"
                                                                    stroke-width="3">
                                                                    <rect width="36" height="36" x="6" y="6" rx="3" />
                                                                    <path d="M13 13h8v8h-8z" />
                                                                    <path stroke-linecap="round" d="M27 13h8m-8 7h8m-22 8h22m-22 7h22" />
                                                                </g>
                                                            </svg>
                                                            View Detail
                                                        </button>
                                                        <div class="absolute z-10 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 bottom-full left-0 mb-2 px-3 py-2 text-xs font-medium text-white bg-gray-900 rounded-lg shadow-sm dark:bg-gray-700 w-48">
                                                            <span class="flex items-center">
                                                                <svg class="w-3 h-3 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H9m3-9a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                </svg>
                                                                You don't have permission to view program details
                                                            </span>
                                                            <div class="absolute top-full left-4 transform border-4 border-transparent border-t-gray-900 dark:border-t-gray-700"></div>
                                                        </div>
                                                    </div>
                                                @endcan
                                            @else
                                                <!-- Jika program belum punya detail -->
                                                @can('add-programDetail')
                                                    <a href="{{ route('programdetail.create', $program->id) }}"
                                                        class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-green-700 bg-green-50 hover:bg-green-100 border border-green-200 rounded-lg transition-colors dark:bg-green-900/30 dark:text-green-300 dark:border-green-800 dark:hover:bg-green-900/50">
                                                        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                        </svg>
                                                        Add Detail
                                                    </a>
                                                @else
                                                    <!-- Disabled Add Detail Button -->
                                                    <div class="relative group">
                                                        <button disabled
                                                            class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:text-gray-500 dark:border-gray-600">
                                                            <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                            </svg>
                                                            Add Detail
                                                        </button>
                                                        <div class="absolute z-10 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 bottom-full left-0 mb-2 px-3 py-2 text-xs font-medium text-white bg-gray-900 rounded-lg shadow-sm dark:bg-gray-700 w-48">
                                                            <span class="flex items-center">
                                                                You don't have permission to add program details
                                                            </span>
                                                            <div class="absolute top-full left-4 transform border-4 border-transparent border-t-gray-900 dark:border-t-gray-700"></div>
                                                        </div>
                                                    </div>
                                                @endcan
                                            @endif

                                            <!-- Edit Button -->
                                            @can('update-program')
                                                <button data-modal-target="editProgramModal{{ $program->id }}"
                                                    data-modal-toggle="editProgramModal{{ $program->id }}"
                                                    class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded-lg transition-colors dark:bg-amber-900/30 dark:text-amber-300 dark:border-amber-800 dark:hover:bg-amber-900/50">
                                                    <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                    Edit
                                                </button>
                                            @else
                                                <!-- Disabled Edit Button -->
                                                <div class="relative group">
                                                    <button disabled
                                                        class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:text-gray-500 dark:border-gray-600">
                                                        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                            </path>
                                                        </svg>
                                                        Edit
                                                    </button>
                                                    <div class="absolute z-10 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 bottom-full left-0 mb-2 px-3 py-2 text-xs font-medium text-white bg-gray-900 rounded-lg shadow-sm dark:bg-gray-700 w-48">
                                                        <span class="flex items-center">
                                                            You don't have permission to edit programs
                                                        </span>
                                                        <div class="absolute top-full left-4 transform border-4 border-transparent border-t-gray-900 dark:border-t-gray-700"></div>
                                                    </div>
                                                </div>
                                            @endcan

                                            <!-- Delete Button -->
                                            @can('delete-program')
                                                <form action="{{ route('programs.destroy', $program->id) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this program?')"
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
                                            @else
                                                <!-- Disabled Delete Button -->
                                                <div class="relative group">
                                                    <button disabled
                                                        class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:text-gray-500 dark:border-gray-600">
                                                        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                        Delete
                                                    </button>
                                                    <div class="absolute z-10 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 bottom-full left-0 mb-2 px-3 py-2 text-xs font-medium text-white bg-gray-900 rounded-lg shadow-sm dark:bg-gray-700 w-52">
                                                        <span class="flex items-center">
                                                            You don't have permission to delete programs
                                                        </span>
                                                        <div class="absolute top-full left-4 transform border-4 border-transparent border-t-gray-900 dark:border-t-gray-700"></div>
                                                    </div>
                                                </div>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="max-w-md mx-auto">
                    <svg class="mx-auto w-16 h-16 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                </path>
                                            </svg>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No programs yet</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">Get started by creating your first program.</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Include Modals (only if user has permission) -->
    @can('add-program')
        @include('programs.create')
    @endcan

    @can('update-program')
        @if (isset($programs) && $programs->count())
            @include('programs.edit')
        @endif
    @endcan

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
            const flashTypes = ['success', 'error', 'warning', 'info'];

            flashTypes.forEach(type => {
                const element = document.getElementById(`flash-${type}`);
                if (element) {
                    showToast(type, element.dataset.message);
                    element.remove();
                }
            });

            // Prevent disabled buttons from opening modals
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
