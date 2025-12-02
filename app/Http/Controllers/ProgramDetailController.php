<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramDetail;
use Illuminate\Http\Request;

class ProgramDetailController extends Controller
{
    // STEP 1 - Form program detail
    public function create($programId)
    {
        $program = Program::findOrFail($programId);

        // kembali ke view step 1
        return view('programDetails.create', compact('program'));
    }

    // STEP 1 - Simpan program detail
    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id|unique:program_details,program_id',
            'description' => 'required|string',
            'degree' => 'required|string',
            'credits_course' => 'required|numeric',
            'period' => 'required|string',
            'competency' => 'nullable|string',
            'career_prospect' => 'nullable|string',
        ]);

        // Simpan program detail
        $detail = ProgramDetail::create($validated);

        // Redirect ke halaman struktur kurikulum (STEP 2)
        return redirect()->route('structure.create', ['id' => $detail->id]);
    }

    public function show(ProgramDetail $programDetail)
    {
        $programDetail->load('structures');
        return view('programDetails.index', compact('programDetail'));
    }

    public function edit(ProgramDetail $programDetail)
    {
        return view('programDetails.edit', compact('programDetail'));
    }

    public function update(Request $request, ProgramDetail $programDetail)
    {
        $validated = $request->validate([
            'description' => 'required',
            'degree' => 'required',
            'credits_course' => 'required|numeric',
            'period' => 'required',
            'competency' => 'required',
            'career_prospect' => 'required',
        ]);

        $programDetail->update($validated);

        return redirect()->route('programdetail.show', $programDetail->id)
            ->with('success', 'Program detail updated!');
    }

    public function destroy(ProgramDetail $programDetail)
    {
        // Hapus semua structure yang terkait
        $programDetail->structures()->delete();

        // Hapus program detail
        $programDetail->delete();

        return redirect()->route('programs.index')
            ->with('success', 'Program detail and structures deleted successfully.');
    }
}
