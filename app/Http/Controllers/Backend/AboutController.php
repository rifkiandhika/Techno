<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::getInfo();
        return view('admin.about.index', compact('aboutUs'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'brand_history' => 'nullable|string',
            'vision'        => 'nullable|string',
            'mission'       => 'nullable|string',
            'founder_story' => 'nullable|string',
            'founder_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $aboutUs = AboutUs::getInfo();

        $data = [
            'brand_history' => $request->brand_history,
            'vision'        => $request->vision,
            'mission'       => $request->mission,
            'founder_story' => $request->founder_story,
        ];

        if ($request->hasFile('founder_photo')) {
            // Hapus foto lama
            if ($aboutUs->founder_photo && file_exists(public_path($aboutUs->founder_photo))) {
                @unlink(public_path($aboutUs->founder_photo));
            }

            $file          = $request->file('founder_photo');
            $filename      = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/about'), $filename);
            $data['founder_photo'] = 'images/about/' . $filename;
        }

        $aboutUs->update($data);

        return redirect()->back()->with('success', 'About Us berhasil diupdate');
    }
}