<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inbox;

class InboxController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $inboxes = Inbox::when($search, function ($query, $search) {
            return $query->where('inbox_nama', 'like', "%{$search}%")
                         ->orWhere('inbox_perihal', 'like', "%{$search}%")
                         ->orWhere('inbox_isi', 'like', "%{$search}%");
        })->paginate(10);
        
        return view('inbox.index', compact('inboxes', 'search'));
    }

    public function create()
    {
        return view('inbox.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'inbox_nama' => 'required|string|max:255',
            'inbox_whatsapp' => 'required|string|max:15',
            'inbox_perihal' => 'required|string|max:255',
            'inbox_isi' => 'required|string',
            'inbox_status' => 'required|boolean',
        ]);

        Inbox::create($request->all());

        return redirect()->route('inbox.index')->with('success', 'Inbox created successfully.');
    }
    public function show(Inbox $inbox)
    {
        return view('inbox.detail', compact('inbox'));
    }
    public function edit(Inbox $inbox)
    {
        return view('inbox.edit', compact('inbox'));
    }
    public function update(Request $request, Inbox $inbox)
    {
        $request->validate([
            'inbox_nama' => 'required|string|max:255',
            'inbox_whatsapp' => 'required|string|max:15',
            'inbox_perihal' => 'required|string|max:255',
            'inbox_isi' => 'required|string',
            'inbox_status' => 'required|boolean',
        ]);

        $inbox->update($request->all());

        return redirect()->route('inbox.index')->with('success', 'Inbox updated successfully.');
    }
    public function destroy(Inbox $inbox)
    {
        $inbox->delete();
        return redirect()->route('inbox.index')->with('success', 'Inbox deleted successfully.');
    }

}
