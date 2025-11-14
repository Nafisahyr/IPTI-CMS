@extends('layout')

@section('title', 'Programs Detail')

@section('content')
    <div class="max-w-screen-xl mx-auto p-6">
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
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Program
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
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Program Detail</h1>
            </div>
        </div>


        <div class="sm:hidden">
            <label for="tabs" class="sr-only"></label>
            <select id="tabs"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option>View</option>
                <option>Edit</option>
            </select>
        </div>
        <div class="hidden sm:block max-w-3xl mx-auto px-4">
            <ul
                class="hidden text-sm font-medium text-center text-gray-500 rounded-lg shadow-sm sm:flex dark:divide-gray-700 dark:text-gray-400">
                <li class="w-full focus-within:z-10">
                    <a href=""
                        class="
                    inline-block w-full p-4 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50
                    rounded-s-lg focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700
                    "
                        aria-current="page">View</a>
                </li>
                <li class="w-full focus-within:z-10">
                    <a href="http://127.0.0.1:8000/programdetail"
                        class="inline-block w-full p-4 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 rounded-r-lg active focus:outline-none dark:bg-gray-700 dark:text-white">Edit</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Form Section -->
    <div class=" mx-auto px-4">
        <!-- Card Container -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header dengan Title dan Actions -->
            <div class="border-b border-gray-200 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-700">Sit sed praesentium elus vitae.</h1>
                    </div>
                </div>
            </div>

            <!-- Informasi Detail -->
            <div class="p-10 space-y-6">
                <!-- Slug dan Tags -->
                <div>
                    <form id="courseForm" class="space-y-6">
                        <!-- Description Field -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                Description <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" name="description" required rows="4"
                                placeholder="Tuliskan prospek karir setelah menyelesaikan course..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
                        </div>

                        <!-- Degree, Credits, Period Row -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Degree Field -->
                            <div>
                                <label for="degree" class="block text-sm font-medium text-gray-700 mb-1">
                                    Degree <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="degree" name="degree" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>

                            <!-- Credits Field -->
                            <div>
                                <label for="credits" class="block text-sm font-medium text-gray-700 mb-1">
                                    Credits <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="credits" name="credits" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>

                            <!-- Period Field -->
                            <div>
                                <label for="period" class="block text-sm font-medium text-gray-700 mb-1">
                                    Period <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="period" name="period" placeholder="e.g., 4 years" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">

                            </div>

                        </div>

                        <!-- Competency Field -->
                        <div>
                            <label for="competency" class="block text-sm font-medium text-gray-700 mb-1">
                                Competency <span class="text-red-500">*</span>
                            </label>
                            <textarea id="competency" name="competency" required rows="4"
                                placeholder="Tuliskan kompetensi yang akan didapatkan..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
                        </div>

                        <!-- Career Prospect Field -->
                        <div>
                            <label for="career-prospect" class="block text-sm font-medium text-gray-700 mb-1">
                                Career Prospect <span class="text-red-500">*</span>
                            </label>
                            <textarea id="career-prospect" name="career-prospect" required rows="4"
                                placeholder="Tuliskan prospek karir setelah menyelesaikan course..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
                        </div>

                        <h1 class="text-xl font-semibold text-gray-800 dark:text-white mb-7">Program Structure</h1>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="year1" class="block text-sm font-medium text-gray-700 mb-1">
                                    Year 1 <span class="text-red-500">*</span>
                                </label>
                                <textarea id="year1" name="year1" required rows="4" placeholder="You’ll experience:"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
                            </div>
                            <div>
                                <label for="year2" class="block text-sm font-medium text-gray-700 mb-1">
                                    Year 2 <span class="text-red-500">*</span>
                                </label>
                                <textarea id="year2" name="year2" required rows="4" placeholder="You’ll master:"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
                            </div>
                            <div>
                                <label for="year3" class="block text-sm font-medium text-gray-700 mb-1">
                                    Year 3 <span class="text-red-500">*</span>
                                </label>
                                <textarea id="year3" name="year3" required rows="4" placeholder="You’ll grow through:"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
                            </div>
                            <div>
                                <label for="year4" class="block text-sm font-medium text-gray-700 mb-1">
                                    Year 4 <span class="text-red-500">*</span>
                                </label>
                                <textarea id="year4" name="year4" required rows="4" placeholder="You’ll create:"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 p-6 bg-gray-50">
                <div class="flex justify-end">
                    <div class="flex space-x-3">
    <button type="submit"
        class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-green-600 bg-green-50 rounded-lg hover:bg-green-100 transition-colors dark:bg-green-900/20 dark:text-green-400 dark:hover:bg-green-900/30">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
            </path>
        </svg>
        <span>Save Changes</span>
    </button>
</div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Submit Button -->
    </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Tunggu sampai DOM selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Handle form submission
            document.getElementById('courseForm').addEventListener('submit', function(e) {
                e.preventDefault();

                // Get form values
                const description = document.getElementById('description').value;
                const degree = document.getElementById('degree').value;
                const credits = document.getElementById('credits').value;
                const period = document.getElementById('period').value;
                const competency = document.getElementById('competency').value;
                const careerProspect = document.getElementById('career-prospect').value;

                // Validate required fields
                if (!description || !degree || !credits || !period || !competency || !careerProspect) {
                    alert('Harap lengkapi semua field yang wajib diisi!');
                    return;
                }

                // Show success message
                alert('Form berhasil disubmit! Data telah disimpan.');

                // In a real application, you would send the form data to a server here
                console.log({
                    description: description,
                    degree: degree,
                    credits: credits,
                    period: period,
                    competency: competency,
                    careerProspect: careerProspect
                });

                // Optional: Reset form after submission
                // this.reset();
            });
        });
    </script>
@endsection
