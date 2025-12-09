@extends('layout')

@section('title', 'Program Details')

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
                    <a href="{{ route('programs.index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-sky-900 dark:text-gray-400 dark:hover:text-white">
                        Programs
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href=""
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-sky-900 md:ms-2 dark:text-gray-400 dark:hover:text-white">Program
                            Detail</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href=""
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-sky-900 md:ms-2 dark:text-gray-400 dark:hover:text-white">View</a>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Program Detail</h1>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="sm:hidden">
            <label for="tabs" class="sr-only"></label>
            <select id="tabs"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white ">
                <option>View</option>
                <option>Edit</option>
            </select>
        </div>
        <div class="hidden sm:block max-w-3xl mx-auto px-4">
            <ul
                class="hidden text-sm font-medium text-center text-gray-500 rounded-lg shadow-sm sm:flex dark:divide-gray-700 dark:text-gray-400">
                <li class="w-full focus-within:z-10">
                    <a href=""
                        class="inline-block w-full p-4 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 rounded-s-lg active focus:outline-none dark:bg-gray-700 dark:text-white"
                        aria-current="page">View</a>
                </li>
                <li class="w-full focus-within:z-10">
                    @can('update-programDetail')
                        <a href="{{ route('programdetail.edit', $programDetail->id) }}"
                            class="inline-block w-full p-4 bg-white border-r border-gray-200 dark:border-gray-700 rounded-lg hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">
                            Edit
                        </a>
                    @else
                        <!-- Disabled Edit Tab -->
                        <div class="relative group">
                            <div
                                class="inline-block w-full p-4 text-gray-400 bg-gray-100 border-r border-gray-200 dark:border-gray-700 rounded-lg cursor-not-allowed">
                                Edit
                                <svg class="w-3 h-3 inline-block ml-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <!-- Tooltip -->
                            <div class="absolute z-10 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-2 text-xs font-medium text-white bg-gray-900 rounded-lg shadow-sm dark:bg-gray-700">
                                <span class="flex items-center">
                                    You don't have permission to edit program details
                                </span>
                                <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-900 dark:border-t-gray-700"></div>
                            </div>
                        </div>
                    @endcan
                </li>
            </ul>
        </div>

        <!-- Card Container -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mt-6">
            <!-- Header dengan Title dan Actions -->
            <div class="border-b border-gray-200 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-700">{{ $programDetail->program->name }}</h1>
                    </div>
                </div>
            </div>

            <!-- Informasi Detail -->
            <div class="space-y-6 p-6">
                <!-- Description -->
                <div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Program Description</label>
                        <div class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-white min-h-[120px]">
                            <p class="text-gray-800 leading-relaxed whitespace-pre-line">
                                {{ $programDetail->description }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Degree, Credits, Period -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Degree</label>
                        <div class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-white">
                            <p class="text-gray-800 font-medium">{{ $programDetail->degree }}</p>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Credits</label>
                        <div class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-white">
                            <p class="text-gray-800 font-medium">{{ $programDetail->credits_course }}</p>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Period</label>
                        <div class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-white">
                            <p class="text-gray-800 font-medium">{{ $programDetail->period }}</p>
                        </div>
                    </div>
                </div>

                <!-- Competency -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Competency</label>
                    <div class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-white min-h-[120px]">
                        <p class="text-gray-800 leading-relaxed whitespace-pre-line">
                            {{ $programDetail->competency ?: '-' }}
                        </p>
                    </div>
                </div>

                <!-- Career Prospect -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Career Prospect</label>
                    <div class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-white min-h-[120px]">
                        <p class="text-gray-800 leading-relaxed whitespace-pre-line">
                            {{ $programDetail->career_prospect ?: '-' }}
                        </p>
                    </div>
                </div>

                <!-- Program Structure -->
                <div class="mt-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Curriculum Structure</h2>

                    <div id="structure-container" class="space-y-4">
                        @if ($programDetail->structures && $programDetail->structures->count() > 0)
                            @foreach ($programDetail->structures as $item)
                                <div
                                    class="grid grid-cols-1 md:grid-cols-12 gap-4 items-start p-4 bg-gray-50 rounded-lg border border-gray-200">
                                    <div class="md:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                                        <div class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-white">
                                            <p class="text-gray-800 font-medium">{{ $item->year }}</p>
                                        </div>
                                    </div>

                                    <div class="md:col-span-9">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                        <div
                                            class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-white min-h-[100px]">
                                            <p class="text-gray-800 leading-relaxed whitespace-pre-line">
                                                {{ $item->description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
                                <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="mt-2 text-gray-500">No curriculum structure added yet</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="border-t border-gray-200 p-6 bg-gray-50">
                <div class="flex justify-between items-center">
                    <!-- Tombol Back (Always enabled) -->
                    <a href="{{ route('programs.index') }}"
                        class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Back to Programs</span>
                    </a>

                    <!-- Tombol Delete -->
                    @can('delete-programDetail')
                        <form action="{{ route('programdetail.destroy', $programDetail->id) }}" method="POST"
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this program?')"
                                class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                <span>Delete Program</span>
                            </button>
                        </form>
                    @else
                        <!-- Disabled Delete Button -->
                        <div class="relative group">
                            <button disabled
                                class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                <span>Delete Program</span>
                                <svg class="w-3 h-3 ml-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                            <!-- Tooltip -->
                            <div class="absolute z-10 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-2 text-xs font-medium text-white bg-gray-900 rounded-lg shadow-sm dark:bg-gray-700">
                                <span class="flex items-center">
                                    You don't have permission to delete program details
                                </span>
                                <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-900 dark:border-t-gray-700"></div>
                            </div>
                        </div>
                    @endcan
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

                // Prevent disabled edit tab from navigating
                document.querySelectorAll('a[href="#"]').forEach(link => {
                    if (link.closest('li').querySelector('div.cursor-not-allowed')) {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            showToast('error', 'You do not have permission to edit program details');
                        });
                    }
                });
            });
        </script>
    @endsection
