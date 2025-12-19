<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;

class ClientController extends Controller
{
    use FileTrait;

    public function index()
    {
        $clients = Client::latest()->get();
        return view('dashboard.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('dashboard.clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request->file('image'), 'clients');
        }

        Client::create($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully.');
    }

    public function edit(Request $request)
    {
        $client = Client::findOrFail($request->id);
        return view('dashboard.clients.edit', compact('client'));
    }

    public function update(Request $request)
    {
        $client = Client::findOrFail($request->id);

        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('image')) {
            $this->deleteFile($client->image);
            $data['image'] = $this->updateFile($request->file('image'), $client->image, 'clients');
        }

        $client->update($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Request $request)
    {
        $client = Client::findOrFail($request->id);
        $this->deleteFile($client->image);
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully.');
    }
}
