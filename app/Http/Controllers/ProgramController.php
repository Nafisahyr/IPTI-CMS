<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProgramController extends Controller
{
    /**
     * Tampilkan semua program.
     */
    public function index()
    {
        $programs = Program::all();
        return view('programs.index', compact('programs'));
    }

    /**
     * Tampilkan form tambah program.
     */
    public function create()
    {
        return view('programs.create');
    }

    /**
     * Simpan program baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'link' => 'nullable|url',
        ]);

        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        while (Program::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        try {
            $path = null;
            if ($request->hasFile('image')) {

                $path = $request->file('image')->store('programs', 'public');
            }

            Program::create([
                'name' => $request->name,
                'slug' => $slug,
                'description' => $request->description,
                'image' => $path,
                'link' => $request->link,
            ]);

            return redirect()->route('programs.index')
                ->with('success', 'Program created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Tampilkan detail program.
     */
    public function show($id)
    {
        $program = Program::with('detail')->findOrFail($id);

    if (!$program->detail) {
        // Kalau belum punya detail → arahkan ke create
        return redirect()->route('programdetail.create', $program->id);
    }

    // Kalau sudah punya detail → tampilkan detailnya
    return redirect()->route('programdetail.show', $program->detail->id);
    }

    /**
     * Tampilkan form edit program.
     */
    public function edit(Program $program)
    {
        return view('programs.edit', compact('program'));
    }

    /**
     * Update data program.
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'link' => 'nullable|url',
        ]);

        try {
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'link' => $request->link,
            ];

            // Update slug jika name berubah
            if ($program->name !== $request->name) {
                $slug = Str::slug($request->name);
                $originalSlug = $slug;
                $count = 1;
                while (Program::where('slug', $slug)->where('id', '!=', $program->id)->exists()) {
                    $slug = $originalSlug . '-' . $count;
                    $count++;
                }
                $data['slug'] = $slug;
            }

            // Jika ada gambar baru
            if ($request->hasFile('image')) {
                // Hapus gambar lama dari storage
                if ($program->image && Storage::disk('public')->exists($program->image)) {
                    Storage::disk('public')->delete($program->image);
                }

                // Simpan gambar baru
                $path = $request->file('image')->store('programs', 'public');
                $data['image'] = $path;
            }

            $program->update($data);

            return redirect()->route('programs.index')
                ->with('success', 'Program updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Hapus program.
     */
    public function destroy(Program $program)
    {
        try {
            // Hapus file dari storage jika ada
            if ($program->image && Storage::disk('public')->exists($program->image)) {
                Storage::disk('public')->delete($program->image);
            }

            $program->delete();

            return redirect()->route('programs.index')
                ->with('success', 'Program deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * API list program (jika dibutuhkan frontend lain).
     */
    public function apiIndex()
    {
        $programs = Program::all();
        return response()->json([
            'success' => true,
            'data' => $programs
        ]);
    }
}
