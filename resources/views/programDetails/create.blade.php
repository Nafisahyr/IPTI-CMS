@extends('layout')

@section('title', 'Create Program Detail')

@section('content')
<div class="max-w-screen-xl mx-auto p-6">
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-3 w-80 max-w-full"></div>

    @if (session('success'))
        <div id="flash-success" data-type="success" data-message="{{ session('success') }}" style="display: none;"></div>
    @endif
    @if (session('error'))
        <div id="flash-error" data-type="error" data-message="{{ session('error') }}" style="display: none;"></div>
    @endif

    <nav class="flex pb-5" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2">
            <li><a href="{{ route('programs.index') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">Programs</a></li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Create Program Detail (1/2)</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white border border-gray-200 rounded-xl shadow-md overflow-hidden p-8">
        <h1 class="text-2xl font-bold mb-6">Create Program Detail</h1>

        {{-- Pastikan $program di-compact dari controller create($programId) --}}
        <div class="mb-6">
            <p class="text-sm text-gray-600">Untuk program: <span class="font-semibold">{{ $program->name ?? '—' }}</span></p>
        </div>

        {{-- Form mengarah ke ProgramDetailController@store --}}
        <form method="POST" action="{{ route('programdetail.store') }}">
            @csrf

            {{-- Hidden program id --}}
            <input type="hidden" name="program_id" value="{{ $program->id }}">

            {{-- Description --}}
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="4" required class="w-full px-4 py-2 border rounded-lg">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Degree / Credits / Period --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="degree" class="block text-sm font-medium text-gray-700 mb-1">Degree <span class="text-red-500">*</span></label>
                    <input type="text" id="degree" name="degree" required value="{{ old('degree') }}" class="w-full px-4 py-2 border rounded-lg">
                    @error('degree') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="credits_course" class="block text-sm font-medium text-gray-700 mb-1">Credits <span class="text-red-500">*</span></label>
                    <input type="number" id="credits_course" name="credits_course" required value="{{ old('credits_course') }}" class="w-full px-4 py-2 border rounded-lg">
                    @error('credits_course') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="period" class="block text-sm font-medium text-gray-700 mb-1">Period <span class="text-red-500">*</span></label>
                    <input type="text" id="period" name="period" required value="{{ old('period') }}" placeholder="e.g., 4 years" class="w-full px-4 py-2 border rounded-lg">
                    @error('period') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Competency --}}
            <div class="mb-4">
                <label for="competency" class="block text-sm font-medium text-gray-700 mb-1">Competency <span class="text-red-500">*</span></label>
                <textarea id="competency" name="competency" rows="3" required class="w-full px-4 py-2 border rounded-lg">{{ old('competency') }}</textarea>
                @error('competency') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Career prospect --}}
            <div class="mb-6">
                <label for="career_prospect" class="block text-sm font-medium text-gray-700 mb-1">Career Prospect <span class="text-red-500">*</span></label>
                <textarea id="career_prospect" name="career_prospect" rows="3" required class="w-full px-4 py-2 border rounded-lg">{{ old('career_prospect') }}</textarea>
                @error('career_prospect') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Note: struktur kurikulum bisa ditambahkan di step 2 (atau di halaman yang sama jika mau combine).
                 Untuk alur yang kamu sebut: setelah simpan, redirect ke create structure --}}

            <a href="{{ route('programdetail.create', $program->id) }}" class="flex items-center justify-end px-4 h-10 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"> Next <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"> <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" /> </svg> </a>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Optional: client-side validation / enhancements (nothing required here — backend akan validasi).
});
</script>
@endsection
