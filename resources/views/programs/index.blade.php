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
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-sky-900 dark:text-gray-400 dark:hover:text-white">
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
        <button data-modal-target="addProgramModal" data-modal-toggle="addProgramModal"
            class="inline-flex items-center px-4 py-3 text-white font-medium rounded-lg bg-sky-700 hover:bg-sky-800 dark:bg-sky-600 dark:hover:bg-sky-700 focus:ring-4 focus:ring-sky-200 dark:focus:ring-sky-800 shadow-lg transition-all duration-200 hover:shadow-xl">
            <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Program
        </button>
    </div>

    <!-- Programs List -->
    @if ($programs->count())
        <x-table>
            <x-slot name="head">
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Image</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Program</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Description</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Actions</th>
            </x-slot>

            <x-slot name="body">
                @foreach ($programs as $program)
                    <tr class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
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
                                @if($program->code)
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
                        </td>

                        <!-- Actions Column -->
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-2">
                                <!-- Detail/Add Detail Button -->
                                @if($program->detail)
                                    <a href="{{ route('programdetail.show', $program->detail->id) }}"
                                       class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 rounded-lg transition-colors dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-800 dark:hover:bg-blue-900/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 48 48" class="flex-shrink-0">
                                            <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="3">
                                                <rect width="36" height="36" x="6" y="6" rx="3"/>
                                                <path d="M13 13h8v8h-8z"/>
                                                <path stroke-linecap="round" d="M27 13h8m-8 7h8m-22 8h22m-22 7h22"/>
                                            </g>
                                        </svg>
                                        View Detail
                                    </a>
                                @else
                                    <a href="{{ route('programdetail.create', $program->id) }}"
                                       class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-green-700 bg-green-50 hover:bg-green-100 border border-green-200 rounded-lg transition-colors dark:bg-green-900/30 dark:text-green-300 dark:border-green-800 dark:hover:bg-green-900/50">
                                        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Add Detail
                                    </a>
                                @endif

                                <!-- Edit Button -->
                                <button data-modal-target="editProgramModal{{ $program->id }}"
                                        data-modal-toggle="editProgramModal{{ $program->id }}"
                                        class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded-lg transition-colors dark:bg-amber-900/30 dark:text-amber-300 dark:border-amber-800 dark:hover:bg-amber-900/50">
                                    <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Edit
                                </button>

                                <!-- Delete Button -->
                                <form action="{{ route('programs.destroy', $program->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this program?')"
                                            class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 rounded-lg transition-colors dark:bg-red-900/30 dark:text-red-300 dark:border-red-800 dark:hover:bg-red-900/50">
                                        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="max-w-md mx-auto">
                <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No programs yet</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Get started by creating your first program.</p>
                <button data-modal-target="addProgramModal" data-modal-toggle="addProgramModal"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-sky-600 hover:bg-sky-700 rounded-lg transition-colors">
                    <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create First Program
                </button>
            </div>
        </div>
    @endif
</div>

<!-- Include Modals -->
@include('programs.create')
@include('programs.edit')

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
        toast.className = `toast flex items-center w-full max-w-xs p-4 text-white rounded-lg shadow-lg ${config.bg} border border-white border-opacity-20`;

        toast.innerHTML = `
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 rounded-lg bg-white bg-opacity-20">
                ${config.icon}
                <span class="sr-only">${type} icon</span>
            </div>
            <div class="ms-3 text-sm font-normal flex-1">${message}</div>
            <button type="button" onclick="removeToast('${toastId}')" class="ms-auto -mx-1.5 -my-1.5 bg-white bg-opacity-20 text-white hover:bg-opacity-30 rounded-lg focus:ring-2 focus:ring-white focus:ring-opacity-50 p-1.5 inline-flex items-center justify-center h-8 w-8 transition-colors">
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
    });
</script>
@endsection
