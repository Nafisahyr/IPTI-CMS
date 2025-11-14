@foreach ($facilities as $facility)
<x-modal id="editFacilityModal{{ $facility->id }}" title="Edit Facility" :showButton="false">
    <form method="POST" action="{{ route('facilities.update', $facility->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid gap-4 mb-4">
            <div>
                <label for="edit_name_{{ $facility->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">facility Name *</label>
                <input type="text" id="edit_name_{{ $facility->id }}" name="name" value="{{ $facility->name }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Enter facility name">
            </div>

            <div>
                <label for="edit_image_{{ $facility->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Facility Image</label>
                <input type="file" name="image" id="edit_image_{{ $facility->id }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    accept="image/*">
                <div class="mt-2">
                    <p class="text-sm text-gray-500 dark:text-gray-300">Current Image:</p>
                    <img src="{{ asset('storage/' . $facility->image) }}" alt="{{ $facility->name }}"
                        class="w-20 h-20 object-cover rounded-lg mt-1">
                </div>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Leave empty to keep current image</p>
            </div>

            <div>
                <label for="edit_description_{{ $facility->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea id="edit_description_{{ $facility->id }}" name="description" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Enter facility description">{{ $facility->description }}</textarea>
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <button type="button"
                    data-modal-hide="editFacilityModal{{ $facility->id }}"
                    class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                Cancel
            </button>
            <button type="submit"
                class="text-white inline-flex items-center bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                <svg class="w-4 h-4 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Update Facility
            </button>
        </div>
    </form>
</x-modal>
@endforeach
