@extends('layout')

@section('title', 'Create Programs Detail')

@section('content')
    <div class="max-w-screen-xl mx-auto p-6">
        <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-3 w-80 max-w-full"></div>

        <!-- Flash Messages Data Elements -->
        @if (session('success'))
            <div id="flash-success" data-type="success" data-message="{{ session('success') }}" style="display: none;"></div>
        @endif

        @if (session('error'))
            <div id="flash-error" data-type="error" data-message="{{ session('error') }}" style="display: none;"></div>
        @endif

        <!-- Breadcrumb Navigation -->
        <nav class="flex pb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="/programs"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
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
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Create
                            Program
                            Detail 2/2</a>
                    </div>
                </li>
            </ol>
        </nav>


        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create Program Detail</h1>
            </div>
        </div>

        <div class="mx-auto w-40 px-4">
            <ol
                class="flex items-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500  rounded-lg  dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                <li class="flex items-center text-gray-500 dark:text-gray-400">
                    <span
                        class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                        1
                    </span>
                    <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 12 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                    </svg>
                </li>
                <li class="flex items-center text-blue-600 dark:text-blue-500">
                    <span
                        class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                        2
                    </span>

                </li>
            </ol>
        </div>
    </div>



    <!-- Form Section -->
    <div class="mx-auto px-4">
        <!-- Card Container -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-md overflow-hidden">

            <!-- Informasi Detail -->
            <div class="p-10 space-y-6">

                <div class="flex justify-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-700">Curriculum Structure</h1>
                    </div>
                </div>

                <form id="courseForm" action="{{ route('structure.store', $programDetail->id) }}" method="POST">
                    @csrf
                    <!-- Description Field -->



                    <div class="grid md:grid-cols-5 gap-4 border-b border-gray-200 p-5">
                        <!-- Description - 4 kolom -->
                        <div class="md:col-span-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                Description <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" name="description" required rows="4"
                                placeholder="Tuliskan prospek karir setelah menyelesaikan course..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
                        </div>

                        <!-- Button + Degree - 1 kolom -->
                        <div class="md:col-span-1">
                            <!-- Add Button di atas -->
                            <button type="button" id="addStructure"
                                class="flex items-center justify-center gap-2 w-full px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors border border-blue-200 mt-6 mb-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add
                            </button>

                            <!-- Degree Field di bawah button -->
                            <label for="year" class="block text-sm font-medium text-gray-700 mb-1">
                                Year <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="year" name="year" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                    </div>

                    <!-- Table preview struktur kurikulum -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold mb-3 text-gray-700">Preview Curriculum Structure</h3>
                        <table class="w-full text-sm text-left text-gray-700 border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 border">#</th>
                                    <th class="px-4 py-2 border">Year</th>
                                    <th class="px-4 py-2 border">Description</th>
                                    <th class="px-4 py-2 border text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="structureTableBody">
                                <tr id="noDataRow">
                                    <td colspan="4" class="text-center py-4 text-gray-500">Belum ada struktur
                                        ditambahkan.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>






                    <!-- Submit Button Section -->
                    <div class="border-t border-gray-200 pt-6 mt-8">
                        <div class="flex justify-end space-x-3">
                            <!-- Cancel Button -->

                            <div class="flex">
                                <!-- Previous Button -->

                                <a href="#"
                                    class="flex items-center justify-center px-4 h-10 me-3 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                                    </svg>
                                    Previous
                                </a>
                                <button type="submit"
                                    class="flex gap-2 items-center justify-center px-4 h-10 me-3 text-base  font-medium border border-gray-300 rounded-lg text-green-600 bg-green-50 hover:bg-green-100 transition-colors dark:bg-green-900/20 dark:text-green-400 dark:hover:bg-green-900/30">
                                    <svg class="w-5 h-5 <svg class="w-4 h-4 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                    Save
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let structures = [];
            let structureCount = 0;

            const addBtn = document.getElementById('addStructure');
            const yearInput = document.getElementById('year');
            const descInput = document.getElementById('description');
            const tableBody = document.getElementById('structureTableBody');
            const noDataRow = document.getElementById('noDataRow');
            const form = document.getElementById('courseForm');

            // Klik tombol Tambah Struktur
            addBtn.addEventListener('click', () => {
                const year = yearInput.value.trim();
                const description = descInput.value.trim();

                if (!year || !description) {
                    alert('Tahun dan deskripsi harus diisi!');
                    return;
                }

                // Hilangkan pesan "belum ada data"
                if (noDataRow) noDataRow.remove();

                structures.push({
                    year,
                    description
                });
                structureCount++;

                // Render tabel
                renderTable();

                // Tambahkan input hidden agar ikut terkirim saat submit
                const hiddenContainer = document.createElement('div');
                hiddenContainer.innerHTML = `
      <input type="hidden" name="structures[${structureCount}][year]" value="${year}">
      <input type="hidden" name="structures[${structureCount}][description]" value="${description}">
    `;
                form.appendChild(hiddenContainer);

                // Kosongkan input
                yearInput.value = '';
                descInput.value = '';
            });

            // Fungsi render tabel
            function renderTable() {
                tableBody.innerHTML = '';
                structures.forEach((s, i) => {
                    const row = document.createElement('tr');
                    row.classList.add('border-b');
                    row.innerHTML = `
        <td class="border px-4 py-2 text-center">${i + 1}</td>
        <td class="border px-4 py-2 text-center">${s.year}</td>
        <td class="border px-4 py-2">${s.description}</td>
        <td class="border px-4 py-2 text-center">
          <button type="button" class="text-red-600 hover:underline" onclick="removeStructure(${i})">Hapus</button>
        </td>
      `;
                    tableBody.appendChild(row);
                });
            }

            // Hapus struktur
            window.removeStructure = (index) => {
                structures.splice(index, 1);
                renderTable();

                // Kalau kosong lagi, tampilkan pesan
                if (structures.length === 0) {
                    tableBody.innerHTML = `
        <tr id="noDataRow">
          <td colspan="4" class="text-center py-4 text-gray-500">Belum ada struktur ditambahkan.</td>
        </tr>
      `;
                }
            };
        });
    </script>
@endsection
