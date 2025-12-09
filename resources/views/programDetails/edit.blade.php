@extends('layout')

@section('title', 'Edit Program Detail')

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
                        class="ms-1 text-sm font-medium text-gray-700 hover:text-sky-900 md:ms-2 dark:text-gray-400 dark:hover:text-white">Edit</a>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Program Detail</h1>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="sm:hidden">
        <label for="tabs" class="sr-only"></label>
        <select id="tabs"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white ">
            <option>View</option>
            <option selected>Edit</option>
        </select>
    </div>
    <div class="hidden sm:block max-w-3xl mx-auto px-4">
        <ul
            class="hidden text-sm font-medium text-center text-gray-500 rounded-lg shadow-sm sm:flex dark:divide-gray-700 dark:text-gray-400">
            <li class="w-full focus-within:z-10">
                <a href="{{ route('programdetail.show', $programDetail->id) }}"
                    class="inline-block w-full p-4 bg-white border-r border-gray-200 dark:border-gray-700 rounded-s-lg hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">View</a>
            </li>
            <li class="w-full focus-within:z-10">
                <a href="{{ route('programdetail.edit', $programDetail->id) }}"
                    class="inline-block w-full p-4 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 rounded-lg active focus:outline-none dark:bg-gray-700 dark:text-white"
                    aria-current="page">Edit</a>
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

        <!-- FORM UPDATE PROGRAM DETAIL -->
        <form action="{{ route('programdetail.update', $programDetail->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="space-y-6">

                <!-- Program Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Program Description</label>
                    <textarea
                        name="description"
                        rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        required
                    >{{ $programDetail->description }}</textarea>
                </div>

                <!-- Degree, Credits, Period -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Degree</label>
                        <input
                            type="text"
                            name="degree"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            value="{{ $programDetail->degree }}"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Credits</label>
                        <input
                            type="text"
                            name="credits_course"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            value="{{ $programDetail->credits_course }}"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Period</label>
                        <input
                            type="text"
                            name="period"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            value="{{ $programDetail->period }}"
                        >
                    </div>
                </div>

                <!-- Competency -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Competency</label>
                    <textarea
                        name="competency"
                        rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    >{{ $programDetail->competency }}</textarea>
                </div>

                <!-- Career Prospect -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Career Prospect</label>
                    <textarea
                        name="career_prospect"
                        rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    >{{ $programDetail->career_prospect }}</textarea>
                </div>

                <!-- Update Program Detail Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                        Update Program Detail
                    </button>
                </div>
            </div>
        </form>

        <hr class="my-6">

        <!-- FORM UPDATE CURRICULUM STRUCTURE -->
        <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Curriculum Structure</h2>

            <form action="{{ route('structure.store.all', $programDetail->id) }}" method="POST" id="curriculumForm">
                @csrf

                <div id="structure-container" class="space-y-4">
                    @foreach ($programDetail->structures as $item)
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 structure-row items-start p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                            <input
                                type="text"
                                name="year[]"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white"
                                value="{{ $item->year }}"
                                required
                            >
                        </div>

                        <div class="md:col-span-8">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea
                                name="description[]"
                                rows="3"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white"
                                required
                            >{{ $item->description }}</textarea>
                        </div>

                        <div class="md:col-span-1 flex items-center justify-center pt-7">
                            @if(!$loop->first)
                            <button type="button"
                                class="delete-row-btn bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                title="Delete this row">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                            @else
                            <div class="w-8 h-8 flex items-center justify-center text-gray-400" title="First row cannot be deleted">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Add More Button -->
                <div class="mt-6">
                    <button type="button" id="add-more"
                        class="flex items-center gap-2 px-4 py-3 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50 transition-all duration-200 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add More Structure
                    </button>
                </div>

                <!-- Update Structure Button -->
                <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                    <button type="submit"
                        class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200">
                        Update Structure
                    </button>
                </div>
            </form>
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

    // Add more structure functionality
    const addMoreBtn = document.getElementById('add-more');
    const structureContainer = document.getElementById('structure-container');

    addMoreBtn.addEventListener('click', function() {
        const newRow = document.createElement('div');
        newRow.className = 'grid grid-cols-1 md:grid-cols-12 gap-4 structure-row items-start p-4 bg-gray-50 rounded-lg border border-gray-200';
        newRow.innerHTML = `
            <div class="md:col-span-3">
                <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                <input
                    type="text"
                    name="year[]"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white"
                    placeholder="e.g., Year 1"
                    required
                >
            </div>
            <div class="md:col-span-8">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea
                    name="description[]"
                    rows="3"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white"
                    placeholder="Enter curriculum description"
                    required
                ></textarea>
            </div>
            <div class="md:col-span-1 flex items-center justify-center pt-7">
                <button type="button" class="delete-row-btn bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                    title="Delete this row">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </button>
            </div>
        `;

        structureContainer.appendChild(newRow);

        // Add animation for new row
        newRow.style.opacity = '0';
        newRow.style.transform = 'translateY(-10px)';
        setTimeout(() => {
            newRow.style.transition = 'all 0.3s ease';
            newRow.style.opacity = '1';
            newRow.style.transform = 'translateY(0)';
        }, 10);
    });

    // Remove structure functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-row-btn')) {
            const row = e.target.closest('.structure-row');
            const allRows = document.querySelectorAll('.structure-row');

            // Don't remove if it's the only row
            if (allRows.length > 1) {
                // Add removal animation
                row.style.transition = 'all 0.3s ease';
                row.style.opacity = '0';
                row.style.transform = 'translateX(-100%)';

                setTimeout(() => {
                    row.remove();
                    showToast('Structure row deleted successfully', 'success');
                }, 300);
            } else {
                showToast('Cannot delete the last structure row', 'error');
            }
        }
    });

    // Form validation
    const curriculumForm = document.getElementById('curriculumForm');
    curriculumForm.addEventListener('submit', function(e) {
        const yearInputs = document.querySelectorAll('input[name="year[]"]');
        const descriptionInputs = document.querySelectorAll('textarea[name="description[]"]');

        let isValid = true;

        yearInputs.forEach((input, index) => {
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('border-red-500', 'ring-2', 'ring-red-200');
            } else {
                input.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
            }
        });

        descriptionInputs.forEach((textarea, index) => {
            if (!textarea.value.trim()) {
                isValid = false;
                textarea.classList.add('border-red-500', 'ring-2', 'ring-red-200');
            } else {
                textarea.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
            }
        });

        if (!isValid) {
            e.preventDefault();
            showToast('Please fill in all required fields', 'error');

            // Scroll to first error
            const firstError = document.querySelector('.border-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
        }
    });
});
</script>
@endsection
