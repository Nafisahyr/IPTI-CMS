@extends('layout')

@section('content')

<div class="max-w-screen-xl mx-auto p-6">
    <nav class="flex pb-5" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2">
            <li>
                <a href="{{ route('eventNews.index') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                    Event News
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Create Event News</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl p-6 border border-gray-100">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                Add News – {{ $event->title }}
            </h2>
        </div>

        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- VALIDATION --}}
        <div id="validationMessage" class="hidden bg-yellow-50 text-yellow-700 p-4 rounded-lg mb-4 items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
        </div>

        {{-- FORM --}}
        <form action="{{ route('eventNews.store', $event->id) }}" method="POST" id="newsForm">
            @csrf

            <input type="hidden" name="event_id" value="{{ $event->id }}">

            <div class="overflow-x-auto rounded-lg border border-gray-200 mb-4">
                <table class="w-full" id="newsTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 text-left font-medium text-gray-700 w-2/5">Title</th>
                            <th class="py-3 px-4 text-left font-medium text-gray-700 w-2/5">Publisher</th>
                            <th class="py-3 px-4 text-left font-medium text-gray-700 w-2/5">Link</th>
                            <th class="py-3 px-4 text-center font-medium text-gray-700 w-1/5">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-gray-200">

                        {{-- EMPTY STATE --}}
                        <tr id="emptyState" class="text-center">
                            <td colspan="4" class="py-8 px-4 text-gray-500">
                                <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <p class="mt-2">No news added yet. Click "Add Row" to start.</p>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center">
                <button type="button" id="addRow"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Row
                </button>

                <div class="flex items-center">
                    <span id="rowCount" class="text-sm text-gray-600 mr-4">0 news added</span>

                    <button type="submit" id="saveButton"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md transition flex items-center disabled:bg-gray-400 disabled:cursor-not-allowed"
                        disabled>
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Save All
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.getElementById("tableBody");
    const addRowBtn = document.getElementById("addRow");
    const saveButton = document.getElementById("saveButton");
    const validationMessage = document.getElementById("validationMessage");
    const rowCount = document.getElementById("rowCount");
    const emptyState = document.getElementById("emptyState");
    const newsForm = document.getElementById("newsForm");

    function countRows() {
        return tableBody.querySelectorAll('input[name="title[]"]').length;
    }

    function updateUI() {
        const count = countRows();
        rowCount.textContent = `${count} news added`;
        saveButton.disabled = count < 1;
    }

    function validateForm() {
        const titles = tableBody.querySelectorAll('input[name="title[]"]');
        const publishers = tableBody.querySelectorAll('input[name="publisher[]"]');

        let isValid = true;
        let errorMessage = '';

        // Reset validation styles
        titles.forEach(input => input.classList.remove('border-red-500'));
        publishers.forEach(input => input.classList.remove('border-red-500'));

        // Validate each row
        titles.forEach((titleInput, index) => {
            const publisherInput = publishers[index];

            if (!titleInput.value.trim()) {
                titleInput.classList.add('border-red-500');
                isValid = false;
                errorMessage = 'Please fill in all title fields';
            }

            if (!publisherInput.value.trim()) {
                publisherInput.classList.add('border-red-500');
                isValid = false;
                errorMessage = 'Please fill in all publisher fields';
            }
        });

        if (!isValid) {
            validationMessage.innerHTML = `
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                ${errorMessage}
            `;
            validationMessage.classList.remove('hidden');
        } else {
            validationMessage.classList.add('hidden');
        }

        return isValid;
    }

    addRowBtn.addEventListener("click", () => {
        if (emptyState) emptyState.remove();

        const row = document.createElement("tr");
        row.classList.add("hover:bg-gray-50");

        row.innerHTML = `
            <td class="py-3 px-4">
                <input type="text" name="title[]" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    placeholder="News title" required>
            </td>
            <td class="py-3 px-4">
                <input type="text" name="publisher[]" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    placeholder="Publisher name" required>
            </td>
            <td class="py-3 px-4">
                <input type="url" name="link[]" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    placeholder="https://example.com">
            </td>
            <td class="py-3 px-4 text-center">
                <button type="button"
                        class="deleteRow bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-md transition">
                    Delete
                </button>
            </td>
        `;
        tableBody.appendChild(row);
        updateUI();
    });

    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("deleteRow")) {
            e.target.closest("tr").remove();

            if (countRows() === 0) {
                tableBody.appendChild(emptyState);
            }

            updateUI();
        }
    });

    // Form submission with validation
    newsForm.addEventListener("submit", function (e) {
        if (!validateForm()) {
            e.preventDefault();
            return;
        }

        // Show loading state
        saveButton.disabled = true;
        saveButton.innerHTML = `
            <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Saving...
        `;
    });

    updateUI();
});
</script>

@endsection
