@extends('layout')

@section('title', 'Edit Event News')

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
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-900">
                        Edit News
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header Section -->
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">
                    Edit News – {{ $eventNew->event->title }}
                </h1>
                <p class="text-gray-600">Update news article information</p>
            </div>
            <a href="{{ route('eventNews.show', $eventNew->event_id) }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to News
            </a>
        </div>

        <!-- Card Container -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- Card Header -->
            <div class="border-b border-gray-200 p-6">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-blue-50 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Edit News Article</h2>
                        <p class="text-gray-500 text-sm">Current title: {{ $eventNew->title }}</p>
                    </div>
                </div>
            </div>

            <!-- FORM UPDATE EVENT NEWS -->
            <form action="{{ route('eventNews.update', $eventNew->id) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Title
                            <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $eventNew->title) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Enter news title"
                            required
                        >
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Publisher -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Publisher
                            <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="publisher"
                            value="{{ old('publisher', $eventNew->publisher) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Enter publisher name"
                            required
                        >
                        @error('publisher')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Link -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Link (Optional)</label>
                        <input
                            type="url"
                            name="link"
                            value="{{ old('link', $eventNew->link) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="https://example.com"
                        >
                        @error('link')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Event Information (Read-only) -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Event Information</h3>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-gray-800 font-medium">{{ $eventNew->event->title }}</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('eventNews.show', $eventNew->event_id) }}"
                            class="px-5 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition font-medium">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Update News
                        </button>
                    </div>
                </div>
            </form>

            <!-- Delete Section -->
            <div class="border-t border-gray-200 p-6 bg-red-50/30">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 mb-1">Delete News Article</h3>
                        <p class="text-gray-600 text-sm">Once deleted, this action cannot be undone.</p>
                    </div>
                    <form action="{{ route('eventNews.destroy', $eventNew->id) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this news article?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-5 py-2.5 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete News
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toast notification system
    function showToast(message, type = 'success') {
        const toastContainer = document.getElementById('toast-container');
        if (!toastContainer) return;

        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        const icon = type === 'success' ?
            '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' :
            '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';

        toast.className = `${bgColor} text-white p-4 rounded-lg shadow-lg flex items-center space-x-3 animate-slide-in`;
        toast.innerHTML = `
            ${icon}
            <span class="flex-1 text-sm">${message}</span>
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

    // Form validation for edit form
    const editForm = document.querySelector('form[action*="update"]');
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            const title = document.querySelector('input[name="title"]');
            const publisher = document.querySelector('input[name="publisher"]');
            const link = document.querySelector('input[name="link"]');

            let isValid = true;

            // Reset previous error states
            [title, publisher, link].forEach(input => {
                input.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
            });

            // Validate title
            if (!title.value.trim()) {
                isValid = false;
                title.classList.add('border-red-500', 'ring-2', 'ring-red-200');
            }

            // Validate publisher
            if (!publisher.value.trim()) {
                isValid = false;
                publisher.classList.add('border-red-500', 'ring-2', 'ring-red-200');
            }

            // Validate link (only if provided)
            if (link.value.trim() && !isValidUrl(link.value)) {
                isValid = false;
                link.classList.add('border-red-500', 'ring-2', 'ring-red-200');
                showToast('Please enter a valid URL', 'error');
            }

            if (!isValid) {
                e.preventDefault();
                showToast('Please fill in all required fields correctly', 'error');

                // Scroll to first error
                const firstError = document.querySelector('.border-red-500');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
        });
    }

    function isValidUrl(string) {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    }
});
</script>
@endsection
