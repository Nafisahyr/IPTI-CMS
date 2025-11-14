<?php

namespace App\Http\Controllers;

use App\Models\CurriculumStructure;
use App\Models\ProgramDetail;
use Illuminate\Http\Request;

class CurriculumStructureController extends Controller
{
    public function create($programDetailId)
{
    // ambil program_detail + relasi program
    $programDetail = ProgramDetail::with('program')->findOrFail($programDetailId);
    $structures = CurriculumStructure::where('program_detail_id', $programDetailId)->get();

    // ambil program dari relasi
    $program = $programDetail->program;

    return view('programDetails.create', compact('programDetail', 'structures', 'program'));
}

    public function store(Request $request, $programDetailId)
    {
        $validated = $request->validate([
            'year' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $validated['program_detail_id'] = $programDetailId;
        CurriculumStructure::create($validated);

        // Cek jumlah struktur yang sudah diinput
        $count = CurriculumStructure::where('program_detail_id', $programDetailId)->count();

        if ($count < 3) {
            return redirect()->route('structure.create', $programDetailId)
                ->with('info', "Struktur ke-$count berhasil disimpan. Minimal 3 struktur diperlukan.");
        }

        return redirect()->route('programdetail.show', $programDetailId)
            ->with('success', 'Semua struktur kurikulum berhasil disimpan!');
    }
}
