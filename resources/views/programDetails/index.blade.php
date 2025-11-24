@extends('layout')

@section('title', 'ProgramDetails')

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
                        <a href="#"
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
                        <a href="#"
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
                    <a href="{{ route('programdetail.edit', $programDetail->id) }}"
                        class="inline-block w-full p-4 bg-white border-r border-gray-200 dark:border-gray-700 rounded-lg hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Edit</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="mx-auto px-4">
        <!-- Card Container -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header dengan Title dan Actions -->
            <div class="border-b border-gray-200 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-700">{{ $programDetail->program->name }}</h1>
                    </div>
                </div>
            </div>

            <!-- Informasi Detail -->
            <div class="p-10 space-y-6">
                <!-- Description -->
                <div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 min-h-[150px]">
                            <p class="text-gray-800 leading-relaxed">
                                {{ $programDetail->description }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Degree, Credits, Period -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Degree</label>
                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                            <p class="text-gray-800 font-medium">{{ $programDetail->degree }}</p>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Credits</label>
                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                            <p class="text-gray-800 font-medium">{{ $programDetail->credits_course }}</p>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Period</label>
                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                            <p class="text-gray-800 font-medium">{{ $programDetail->period }}</p>
                        </div>
                    </div>
                </div>

                <!-- Competency -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Competency</label>
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 min-h-[150px]">
                        <p class="text-gray-800 leading-relaxed">
                            {{ $programDetail->competency ?: '-' }}
                        </p>
                    </div>
                </div>

                <!-- Career Prospect -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Career Prospect</label>
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 min-h-[150px]">
                        <p class="text-gray-800 leading-relaxed">
                             {{ $programDetail->career_prospect ?: '-' }}
                        </p>
                    </div>
                </div>

                <!-- Program Structure -->
                <h1 class="text-xl font-semibold text-gray-800 dark:text-white mb-7">Program Structure</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($programDetail->structures as $structure)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Year {{ $structure->year }}
                        </label>
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 min-h-[150px]">
                            <p class="text-gray-800 leading-relaxed">
                                {{ $structure->description }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="border-t border-gray-200 p-6 bg-gray-50">
                <div class="flex justify-between items-center">
                    <!-- Tombol Back -->
                    <a href="{{ route('programs.index') }}"
                        class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span>Back to Programs</span>
                    </a>

                    <!-- Tombol Delete -->
                    <form action="{{ route('programdetail.destroy', $programDetail->id) }}" method="POST" class="inline">
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

        toast.className = `${bgColor} text-white p-4 rounded-lg shadow-lg flex items-center space-x-3 transform transition-transform duration-300 ease-in-out`;
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
