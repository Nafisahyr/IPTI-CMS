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
            <button data-modal-target="addBannerModal" data-modal-toggle="addBannerModal"
                class="inline-flex items-center px-4 py-2  text-white  font-medium rounded-lg bg-sky-800  hover:bg-sky-950  dark:bg-sky-950   dark:hover:bg-sky-800 focus:ring-4 focus:ring-amber-500 focus:outline-none dark:focus:ring-amber-500 shadow-xl transition-all duration-200 hover:scale-110">
                <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Add Banners
            </button>
        </div>

        <!-- Banners List -->
        @if ($banners->count())
            <x-table>
                <x-slot name="head">
                    <th class="px-6 py-3">Image</th>
                    <th class="px-6 py-3">Actions</th>
                </x-slot>

                <x-slot name="body">
                    @foreach ($banners as $banner)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                               <img src="{{ asset('storage/' . $banner->image) }}"
                                    class="w-20 h-20 object-cover rounded-lg shadow-sm" alt="{{ $banner->name }}">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-3">
                                    <!-- Edit Button -->
                                    <button data-modal-target="editBannerModal{{ $banner->id }}"
                                        data-modal-toggle="editBannerModal{{ $banner->id }}"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                                        <svg class="w-5 h-5 inline me-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <form action="{{ route('banners.destroy', $banner->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this Banner?')"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 font-medium">
                                            <svg class="w-5 h-5 inline me-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
            <div class="text-center py-12">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No banners yet</h3>
                <p class="mt-2 text-gray-500 dark:text-gray-400">Get started by creating your first banner.</p>
                <div class="mt-6">
                    <button data-modal-target="addBannerModal" data-modal-toggle="addBannerModal"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Banner
                    </button>
                </div>
            </div>
        @endif
        </div>

        <!-- Include Modals -->
        @include('banners.create')
        @include('banners.edit')

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
                    `toast flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800 ${config.bg} text-black`;

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
        <div class="absolute bottom-0 left-0 h-1 bg-white bg-opacity-30 progress-bar rounded-b-lg"></div>
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
                // Handle success messages
                const successElement = document.getElementById('flash-success');
                if (successElement) {
                    showToast('success', successElement.dataset.message);
                    successElement.remove();
                }

                // Handle error messages
                const errorElement = document.getElementById('flash-error');
                if (errorElement) {
                    showToast('error', errorElement.dataset.message);
                    errorElement.remove();
                }

                // Hapus toast saat klik close button di modal (jika ada)
                const closeButtons = document.querySelectorAll('[data-dismiss-target]');
                closeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const target = this.getAttribute('data-dismiss-target');
                        const toast = document.querySelector(target);
                        if (toast) {
                            toast.remove();
                        }
                    });
                });
            });
        </script>
    @endsection
