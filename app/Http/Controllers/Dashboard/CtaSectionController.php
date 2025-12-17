<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CtaSection;
use Illuminate\Http\Request;

class CtaSectionController extends Controller
{
    public function edit()
    {
        $cta = CtaSection::firstOrNew();
        return view('dashboard.cta.edit', compact('cta'));
    }

    public function update(Request $request)
    {
        $cta = CtaSection::firstOrNew();

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $cta->fill($data)->save();

        return redirect()->back()->with('success', 'CTA section updated successfully.');
    }
}
