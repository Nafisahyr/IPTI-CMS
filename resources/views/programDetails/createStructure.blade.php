@extends('layout')

@section('content')

    <div class="max-w-screen-xl mx-auto p-6">
        <nav class="flex pb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li>
                    <a href="{{ route('programs.index') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                        Programs
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Create Program Detail (2/2)</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl p-6 border border-gray-100">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    Add Curriculum Structure – {{ $program->name }}
                </h2>
                <p class="text-gray-600">Add the curriculum structure by year for this program (minimum 3 years required)
                </p>
            </div>

            {{-- INFO / SUCCESS MESSAGE --}}
            @if (session('info'))
                <div class="bg-blue-50 text-blue-700 p-4 rounded-lg mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('info') }}
                </div>
            @endif
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

            {{-- VALIDATION MESSAGE --}}
            <div id="validationMessage" class="hidden bg-yellow-50 text-yellow-700 p-4 rounded-lg mb-4 items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <span>Minimum 3 years of curriculum structure are required to save.</span>
            </div>

            {{-- FORM WRAPPER --}}
            <form action="{{ route('structure.store.all', $programDetail->id) }}" method="POST" id="curriculumForm">
                @csrf

                <div class="overflow-x-auto rounded-lg border border-gray-200 mb-4">
                    <table class="w-full" id="structureTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-4 text-left font-medium text-gray-700 w-1/5">Year</th>
                                <th class="py-3 px-4 text-left font-medium text-gray-700 w-3/5">Description</th>
                                <th class="py-3 px-4 text-center font-medium text-gray-700 w-1/5">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody" class="divide-y divide-gray-200">
                            {{-- Existing rows from DB --}}
                            @if ($structures->count() > 0)
                                @foreach ($structures as $s)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4">
                                            <input type="text" name="year[]" value="{{ $s->year }}"
                                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                                required>
                                        </td>
                                        <td class="py-3 px-4">
                                            <textarea name="description[]"
                                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                                rows="2" required>{{ $s->description }}</textarea>
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            @if ($structures->count() > 3)
                                                <button type="button"
                                                    class="deleteRow bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-md transition flex items-center justify-center mx-auto">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                    Delete
                                                </button>
                                            @else
                                                <span class="text-gray-400 text-sm">Required</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr id="emptyState" class="text-center">
                                    <td colspan="3" class="py-8 px-4 text-gray-500">
                                        <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        <p class="mt-2">No curriculum structure added yet. Click "Add Row" to get started.
                                        </p>
                                        <p class="text-sm mt-1 text-yellow-600">Minimum 3 years required.</p>
                                    </td>
                                </tr>
                            @endif
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
                        <span id="rowCount" class="text-sm text-gray-600 mr-4">
                            @if ($structures->count() > 0)
                                {{ $structures->count() }}/3 years added
                            @else
                                0/3 years added
                            @endif
                        </span>
                        <button type="submit" id="saveButton"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md transition flex items-center disabled:bg-gray-400 disabled:cursor-not-allowed"
                            @if ($structures->count() < 3) disabled @endif>
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
        document.addEventListener("DOMContentLoaded", function() {
            const tableBody = document.getElementById("tableBody");
            const addRowBtn = document.getElementById("addRow");
            const saveButton = document.getElementById("saveButton");
            const validationMessage = document.getElementById("validationMessage");
            const rowCount = document.getElementById("rowCount");
            const emptyState = document.getElementById("emptyState");
            const form = document.getElementById("curriculumForm");

            // Function to count rows (excluding empty state)
            function countRows() {
                const rows = tableBody.querySelectorAll('tr');
                let count = 0;

                rows.forEach(row => {
                    // Only count rows that have input fields (not empty state)
                    if (row.querySelector('input[name="year[]"]')) {
                        count++;
                    }
                });

                return count;
            }

            // Function to update UI based on row count
            function updateUI() {
                const rowCountValue = countRows();

                // Update row count display
                rowCount.textContent = `${rowCountValue}/3 years added`;

                // Enable/disable save button
                if (rowCountValue >= 3) {
                    saveButton.disabled = false;
                    validationMessage.classList.add('hidden');
                } else {
                    saveButton.disabled = true;
                    if (rowCountValue > 0) {
                        validationMessage.classList.remove('hidden');
                    } else {
                        validationMessage.classList.add('hidden');
                    }
                }

                // Show/hide delete buttons for required rows (first 3)
                const rows = tableBody.querySelectorAll('tr');
                rows.forEach((row, index) => {
                    const deleteButton = row.querySelector('.deleteRow');
                    const requiredText = row.querySelector('.required-text');

                    if (deleteButton) {
                        if (rowCountValue <= 3 && index < 3) {
                            // Hide delete button and show required text for first 3 rows
                            deleteButton.classList.add('hidden');
                            if (!requiredText) {
                                const requiredSpan = document.createElement('span');
                                requiredSpan.className = 'text-gray-400 text-sm required-text';
                                requiredSpan.textContent = 'Required';
                                deleteButton.parentNode.appendChild(requiredSpan);
                            }
                        } else {
                            // Show delete button and remove required text
                            deleteButton.classList.remove('hidden');
                            if (requiredText) {
                                requiredText.remove();
                            }
                        }
                    }
                });
            }

            // ADD ROW
            addRowBtn.addEventListener("click", function() {
                // Remove empty state if it exists
                if (emptyState) {
                    emptyState.remove();
                }

                const row = document.createElement("tr");
                row.classList.add("hover:bg-gray-50");

                row.innerHTML = `
                <td class="py-3 px-4">
                    <input type="text" name="year[]"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="e.g., Year 1" required>
                </td>
                <td class="py-3 px-4">
                    <textarea name="description[]"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            rows="2" placeholder="Enter curriculum description for this year" required></textarea>
                </td>
                <td class="py-3 px-4 text-center">
                    <button type="button"
                            class="deleteRow bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-md transition flex items-center justify-center mx-auto">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </td>
            `;
                tableBody.appendChild(row);
                updateUI();
            });

            // DELETE ROW (event delegation)
            document.addEventListener("click", function(e) {
                if (e.target.classList.contains("deleteRow") || e.target.closest(".deleteRow")) {
                    const row = e.target.closest("tr");
                    const rowCountValue = countRows();

                    // Prevent deletion if it would result in less than 3 rows
                    if (rowCountValue <= 3) {
                        validationMessage.classList.remove('hidden');
                        validationMessage.innerHTML = `
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Cannot delete. Minimum 3 years of curriculum structure are required.</span>
                    `;
                        return;
                    }

                    row.remove();

                    // Show empty state if no rows left
                    if (countRows() === 0) {
                        const emptyRow = document.createElement("tr");
                        emptyRow.id = "emptyState";
                        emptyRow.innerHTML = `
                        <td colspan="3" class="py-8 px-4 text-gray-500 text-center">
                            <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="mt-2">No curriculum structure added yet. Click "Add Row" to get started.</p>
                            <p class="text-sm mt-1 text-yellow-600">Minimum 3 years required.</p>
                        </td>
                    `;
                        tableBody.appendChild(emptyRow);
                    }

                    updateUI();
                }
            });

            // FORM SUBMISSION VALIDATION
            form.addEventListener('submit', function(e) {
                if (countRows() < 3) {
                    e.preventDefault();
                    validationMessage.classList.remove('hidden');
                    validationMessage.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            });

            // Initialize UI on page load
            updateUI();
        });
    </script>

@endsection
