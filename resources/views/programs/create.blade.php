<x-modal id="addProgramModal" title="Add New Program" :showButton="false">
    <form method="POST" action="{{ route('programs.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid gap-4 mb-4">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Program Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Enter program name">
            </div>

            <div class="grid gap-2 mb-2 md:grid-cols-2">
            <div>
                <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Program Image *</label>
                <input type="file" name="image" id="image"
                    class="w-full px-2 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    accept="image/*" required>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG, JPEG up to 5MB</p>
            </div>

            
            </div>

            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Enter program description">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <button type="button"
                    data-modal-hide="addProgramModal"
                    class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                Cancel
            </button>
            <button type="submit"
                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
                Add Program
            </button>
        </div>
    </form>
</x-modal>
