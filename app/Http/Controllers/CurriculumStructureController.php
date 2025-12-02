<?php

namespace App\Http\Controllers;

use App\Models\CurriculumStructure;
use App\Models\ProgramDetail;
use Illuminate\Http\Request;

class CurriculumStructureController extends Controller
{
    /**
     * Halaman create structure
     */
    public function create($programDetailId)
    {
        // Ambil program_detail dan relasi program
        $programDetail = ProgramDetail::with('program')->findOrFail($programDetailId);

        // Ambil semua struktur yang sudah ada
        $structures = CurriculumStructure::where('program_detail_id', $programDetailId)->get();

        // Ambil program dari relasi
        $program = $programDetail->program;

        return view('programDetails.createStructure', compact('programDetail', 'structures', 'program'));
    }

    /**
     * Simpan struktur kurikulum
     */
    public function store(Request $request, $programDetailId)
    {
        $validated = $request->validate([
            'year' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Set foreign key
        $validated['program_detail_id'] = $programDetailId;

        // Simpan data
        CurriculumStructure::create($validated);

        // Hitung total struktur yang sudah dibuat
        $count = CurriculumStructure::where('program_detail_id', $programDetailId)->count();

        // Jika kurang dari 3, tetap kembali ke halaman tambah
        if ($count < 3) {
            return redirect()
                ->route('structure.create', $programDetailId)
                ->with('info', "Struktur ke-$count berhasil disimpan. Minimal 3 struktur diperlukan.");
        }

        // Jika sudah 3 atau lebih, kembali ke halaman detail
        return redirect()
            ->route('programdetail.show', $programDetailId)
            ->with('success', 'Semua struktur kurikulum berhasil disimpan!');
    }

    public function storeAll(Request $request, $programDetailId)
    {
        // hapus data lama
        CurriculumStructure::where('program_detail_id', $programDetailId)->delete();

        // simpan data baru
        foreach ($request->year as $index => $year) {
            CurriculumStructure::create([
                'program_detail_id' => $programDetailId,
                'year' => $request->year[$index],
                'description' => $request->description[$index],
            ]);
        }

        return redirect()
            ->route('programdetail.show', $programDetailId)
            ->with('success', 'Curriculum structure updated!');
    }
}
