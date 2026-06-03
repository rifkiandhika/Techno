<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'founder_story' => 'nullable|string',
            'founder_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $aboutUs = AboutUs::getInfo();
        
        $data = [
            'brand_history' => $request->brand_history,
            'vision' => $request->vision,
            'mission' => $request->mission,
            'founder_story' => $request->founder_story,
        ];

        if ($request->hasFile('founder_photo')) {
            if ($aboutUs->founder_photo && Storage::disk('public')->exists($aboutUs->founder_photo)) {
                Storage::disk('public')->delete($aboutUs->founder_photo);
            }
            $data['founder_photo'] = $request->file('founder_photo')->store('about', 'public');
        }

        $aboutUs->update($data);

        return redirect()->back()->with('success', 'About Us berhasil diupdate');
    }
}
