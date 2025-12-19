<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\Request;

class ContactSettingController extends Controller
{
    public function edit()
    {
        $setting = ContactSetting::firstOrCreate([]);
        return view('dashboard.contact_settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = ContactSetting::firstOrCreate([]);

        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'map_url' => 'nullable|string',
            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
        ]);

        $setting->update($data);

        return redirect()->route('admin.contact-settings.edit')->with('success', 'Contact settings updated successfully.');
    }
}
