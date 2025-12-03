<?php

namespace App\Http\Controllers;

use App\Models\TuitionFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TuitionFeeController extends Controller
{
    /**
     * Tampilkan semua tuitionFee.
     */
    public function index()
    {
        $tuitionFees = tuitionFee::all();
        return view('tuitionFees.index', compact('tuitionFees'));
    }

    /**
     * Tampilkan form tambah tuitionFee.
     */
    public function create()
    {
        return view('tuitionFees.create');
    }

    /**
     * Simpan tuitionFee baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                // Simpan ke storage/app/public/tuitionFees
                $imagePath = $request->file('image')->store('tuitionFees', 'public');
            }

            tuitionFee::create([
                'image' => $imagePath,
            ]);

            return redirect()->route('tuitionFees.index')
                ->with('success', 'tuitionFee created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Tampilkan detail tuitionFee.
     */
    public function show(tuitionFee $tuitionFee)
    {
        return view('tuitionFees.index', compact('tuitionFee'));
    }

    /**
     * Tampilkan form edit tuitionFee.
     */
    public function edit(tuitionFee $tuitionFee)
    {
        return view('tuitionFees.edit', compact('tuitionFee'));
    }

    /**
     * Update data tuitionFee.
     */
    public function update(Request $request, tuitionFee $tuitionFee)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        try {
            $data = [];

            if ($request->hasFile('image')) {
                // Hapus gambar lama
                if ($tuitionFee->image && Storage::disk('public')->exists($tuitionFee->image)) {
                    Storage::disk('public')->delete($tuitionFee->image);
                }

                // Simpan gambar baru
                $data['image'] = $request->file('image')->store('tuitionFees', 'public');
            }

            $tuitionFee->update($data);

            return redirect()->route('tuitionFees.index')
                ->with('success', 'tuitionFee updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Hapus tuitionFee.
     */
    public function destroy(tuitionFee $tuitionFee)
    {
        try {
            if ($tuitionFee->image && Storage::disk('public')->exists($tuitionFee->image)) {
                Storage::disk('public')->delete($tuitionFee->image);
            }

            $tuitionFee->delete();

            return redirect()->route('tuitionFees.index')
                ->with('success', 'tuitionFee deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Endpoint API tuitionFees.
     */
    public function apiIndex()
    {
        $tuitionFees = tuitionFee::all();

        return response()->json([
            'success' => true,
            'data' => $tuitionFees
        ]);
    }
}
