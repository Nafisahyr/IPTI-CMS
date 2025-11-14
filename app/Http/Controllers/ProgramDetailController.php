<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramDetail;
use Illuminate\Http\Request;

class ProgramDetailController extends Controller
{
    public function create($programId)
    {
        $program = Program::findOrFail($programId);
        return view('programDetails.create', compact('program'));
    }

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

    // Redirect ke halaman tambah struktur
    return redirect()->route('structure.create', ['programDetail' => $detail->id]);
}



    public function show(ProgramDetail $programDetail)
    {
        $programDetail->load('curriculumStructures');
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
            ->with('success', 'Program detail berhasil diperbarui.');
    }
}
