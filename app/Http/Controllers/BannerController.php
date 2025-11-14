<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Tampilkan semua banner.
     */
    public function index()
    {
        $banners = Banner::all();
        return view('banners.index', compact('banners'));
    }

    /**
     * Tampilkan form tambah banner.
     */
    public function create()
    {
        return view('banners.create');
    }

    /**
     * Simpan banner baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        try {
            $imagePath = null;

            if ($request->hasFile('image')) {
                // Simpan gambar ke storage/app/public/banners
                $imagePath = $request->file('image')->store('banners', 'public');
            }

            Banner::create([
                'image' => $imagePath,
            ]);

            return redirect()->route('banners.index')
                ->with('success', 'Banner created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Tampilkan detail banner.
     */
    public function show(Banner $banner)
    {
        return view('banners.index', compact('banner'));
    }

    /**
     * Tampilkan form edit banner.
     */
    public function edit(Banner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    /**
     * Update data banner.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        try {
            $data = [];

            if ($request->hasFile('image')) {
                // Hapus gambar lama kalau ada
                if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                    Storage::disk('public')->delete($banner->image);
                }

                // Simpan gambar baru
                $data['image'] = $request->file('image')->store('banners', 'public');
            }

            $banner->update($data);

            return redirect()->route('banners.index')
                ->with('success', 'Banner updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Hapus banner.
     */
    public function destroy(Banner $banner)
    {
        try {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            $banner->delete();

            return redirect()->route('banners.index')
                ->with('success', 'Banner deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
