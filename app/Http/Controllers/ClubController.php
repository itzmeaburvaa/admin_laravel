<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::all();
        return view('form', compact('clubs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'club_name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'introduction' => 'required|string',
            'mission' => 'required|string',
            'staff_coordinator_name' => 'required|string|max:255',
            'staff_coordinator_email' => 'required|email|max:255',
            'staff_coordinator_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'year_started' => 'required|digits:4',
        ]);

        // ✅ Store logo in shared_storage/logos
        $validated['logo'] = $request->file('logo')->store('club_logos', 'public');

        // ✅ Store staff photo in shared_storage/staffs
        if ($request->hasFile('staff_coordinator_photo')) {
            $validated['staff_coordinator_photo'] = $request->file('staff_coordinator_photo')->store('staff_photos', 'public');
        }

        Club::create($validated);

        return redirect()->route('form')->with('success', '🎉 Club created successfully!');
    }

    public function update(Request $request, $id)
    {
        $club = Club::findOrFail($id);

        $validated = $request->validate([
            'club_name' => 'required|string|max:255',
            'introduction' => 'nullable|string',
            'mission' => 'nullable|string',
            'staff_coordinator_name' => 'nullable|string|max:255',
            'staff_coordinator_email' => 'nullable|email|max:255',
            'year_started' => 'nullable|digits:4',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'staff_coordinator_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update logo if uploaded
        if ($request->hasFile('logo')) {
            if ($club->logo && Storage::disk('public')->exists($club->logo)) {
                Storage::disk('public')->delete($club->logo);
            }

            $validated['logo'] = $request->file('logo')->store('club_logos', 'public');
        }

        // Update staff photo if uploaded
        if ($request->hasFile('staff_coordinator_photo')) {
            if ($club->staff_coordinator_photo && Storage::disk('public')->exists($club->staff_coordinator_photo)) {
                Storage::disk('public')->delete($club->staff_coordinator_photo);
            }

            $validated['staff_coordinator_photo'] = $request->file('staff_coordinator_photo')->store('staff_photos', 'public');
        }

        $club->update($validated);

        return redirect()->route('form')->with('success', '✅ Club updated successfully!');
    }

    public function destroy($id)
    {
        $club = Club::findOrFail($id);

        // ✅ Optional: delete image files
        if ($club->logo && Storage::disk('public')->exists($club->logo)) {
            Storage::disk('public')->delete($club->logo);
        }

        if ($club->staff_coordinator_photo && Storage::disk('public')->exists($club->staff_coordinator_photo)) {
            Storage::disk('public')->delete($club->staff_coordinator_photo);
        }

        $club->delete();

        return redirect()->route('form')->with('success', '🗑️ Club deleted successfully.');
    }
}
