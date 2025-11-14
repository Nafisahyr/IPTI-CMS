<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FacilityController extends Controller
{
    /**
     * Tampilkan semua facility.
     */
    public function index()
    {
        $facilities = Facility::all();
        return view('facilities.index', compact('facilities'));
    }

    /**
     * Form tambah facility.
     */
    public function create()
    {
        return view('facilities.create');
    }

    /**
     * Simpan facility baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'link' => 'nullable|url',
        ]);

        // Buat slug unik
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        while (Facility::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                // Simpan ke storage/app/public/facilities
                $imagePath = $request->file('image')->store('facilities', 'public');
            }

            Facility::create([
                'name' => $request->name,
                'slug' => $slug,
                'description' => $request->description,
                'image' => $imagePath,
                'link' => $request->link,
            ]);

            return redirect()->route('facilities.index')
                ->with('success', 'Facility created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Detail facility.
     */
    public function show(Facility $facility)
    {
        return view('facilities.index', compact('facility'));
    }

    /**
     * Form edit facility.
     */
    public function edit(Facility $facility)
    {
        return view('facilities.edit', compact('facility'));
    }

    /**
     * Update facility.
     */
    public function update(Request $request, Facility $facility)
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
            if ($facility->name !== $request->name) {
                $slug = Str::slug($request->name);
                $originalSlug = $slug;
                $count = 1;
                while (Facility::where('slug', $slug)->where('id', '!=', $facility->id)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }
                $data['slug'] = $slug;
            }

            // Update gambar jika ada file baru
            if ($request->hasFile('image')) {
                // Hapus gambar lama
                if ($facility->image && Storage::disk('public')->exists($facility->image)) {
                    Storage::disk('public')->delete($facility->image);
                }

                // Upload baru ke storage/app/public/facilities
                $data['image'] = $request->file('image')->store('facilities', 'public');
            }

            $facility->update($data);

            return redirect()->route('facilities.index')
                ->with('success', 'Facility updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Hapus facility.
     */
    public function destroy(Facility $facility)
    {
        try {
            if ($facility->image && Storage::disk('public')->exists($facility->image)) {
                Storage::disk('public')->delete($facility->image);
            }

            $facility->delete();

            return redirect()->route('facilities.index')
                ->with('success', 'Facility deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Endpoint API facilities.
     */
    public function apiIndex()
    {
        $facilities = Facility::all();

        return response()->json([
            'success' => true,
            'data' => $facilities
        ]);
    }
}
