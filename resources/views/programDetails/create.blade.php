@extends('layout')

@section('title', 'Create Program Detail')

@section('content')
<div class="max-w-screen-xl mx-auto p-6">
    {{-- Breadcrumb --}}
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
                    <span class="text-sm font-medium text-gray-700">Create Program Detail (1/2)</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white border border-gray-200 rounded-xl shadow-md p-8">
        <h1 class="text-2xl font-bold mb-6">Program Detail</h1>

        {{-- Info Program --}}
        <p class="mb-4 text-gray-700 text-sm">
            Untuk program :
            <span class="font-semibold">{{ $program->name }}</span>
        </p>

        {{-- FORM STEP 1 --}}
        <form action="{{ route('programdetail.store') }}" method="POST">
            @csrf

            <input type="hidden" name="program_id" value="{{ $program->id }}">

            {{-- DESCRIPTION --}}
            <div class="mb-5">
                <label class="block mb-1 font-medium">Description *</label>
                <textarea name="description" rows="4" class="w-full border rounded-lg p-3"
                    required>{{ old('description') }}</textarea>
                @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- DEGREE --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
                <div>
                    <label class="block mb-1 font-medium">Degree *</label>
                    <input type="text" name="degree" class="w-full p-3 border rounded-lg"
                        value="{{ old('degree') }}" required>
                    @error('degree') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Credits *</label>
                    <input type="number" name="credits_course" class="w-full p-3 border rounded-lg"
                        value="{{ old('credits_course') }}" required>
                    @error('credits_course') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Period *</label>
                    <input type="text" name="period" class="w-full p-3 border rounded-lg"
                        placeholder="e.g., 4 years" value="{{ old('period') }}" required>
                    @error('period') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- COMPETENCY --}}
            <div class="mb-5">
                <label class="block mb-1 font-medium">Competency *</label>
                <textarea name="competency" rows="3" class="w-full p-3 border rounded-lg" required>{{ old('competency') }}</textarea>
                @error('competency') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- CAREER --}}
            <div class="mb-8">
                <label class="block mb-1 font-medium">Career Prospect *</label>
                <textarea name="career_prospect" rows="3" class="w-full p-3 border rounded-lg"
                    required>{{ old('career_prospect') }}</textarea>
                @error('career_prospect') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- SUBMIT (NEXT) --}}
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                    Next →
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
