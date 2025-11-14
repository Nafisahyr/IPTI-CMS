<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdmissionController extends Controller
{
    /**
     * Tampilkan semua admission.
     */
    public function index()
    {
        $admissions = Admission::all();
        return view('admissions.index', compact('admissions'));
    }

    /**
     * Tampilkan form tambah admission.
     */
    public function create()
    {
        return view('admissions.create');
    }

    /**
     * Simpan admission baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                // Simpan ke storage/app/public/admissions
                $imagePath = $request->file('image')->store('admissions', 'public');
            }

            Admission::create([
                'image' => $imagePath,
            ]);

            return redirect()->route('admissions.index')
                ->with('success', 'Admission created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Tampilkan detail admission.
     */
    public function show(Admission $admission)
    {
        return view('admissions.index', compact('admission'));
    }

    /**
     * Tampilkan form edit admission.
     */
    public function edit(Admission $admission)
    {
        return view('admissions.edit', compact('admission'));
    }

    /**
     * Update data admission.
     */
    public function update(Request $request, Admission $admission)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        try {
            $data = [];

            if ($request->hasFile('image')) {
                // Hapus gambar lama
                if ($admission->image && Storage::disk('public')->exists($admission->image)) {
                    Storage::disk('public')->delete($admission->image);
                }

                // Simpan gambar baru
                $data['image'] = $request->file('image')->store('admissions', 'public');
            }

            $admission->update($data);

            return redirect()->route('admissions.index')
                ->with('success', 'Admission updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Hapus admission.
     */
    public function destroy(Admission $admission)
    {
        try {
            if ($admission->image && Storage::disk('public')->exists($admission->image)) {
                Storage::disk('public')->delete($admission->image);
            }

            $admission->delete();

            return redirect()->route('admissions.index')
                ->with('success', 'Admission deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Endpoint API admissions.
     */
    public function apiIndex()
    {
        $admissions = Admission::all();

        return response()->json([
            'success' => true,
            'data' => $admissions
        ]);
    }
}
