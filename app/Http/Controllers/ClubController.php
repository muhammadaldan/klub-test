<?php

namespace App\Http\Controllers;
use App\Models\Club;

use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::all();
        return view('clubs.index', compact('clubs'));
    }

    public function create()
    {
        return view('clubs.create');
    }

    public function edit($id)
    {
        $club = Club::findOrFail($id);
        return view('clubs.edit', compact('club'));
    }    

    public function store(Request $request)
    {
        $request->validate([
            'nama_klub' => 'required|unique:clubs,nama_klub',
            'kota_klub' => 'required',
        ]);

        Club::create([
            'nama_klub' => $request->nama_klub,
            'kota_klub' => $request->kota_klub,
        ]);

        return redirect()->route('clubs.index')->with('success', 'Klub berhasil ditambahkan.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_klub' => 'required|unique:clubs,nama_klub,' . $id,
            'kota_klub' => 'required',
        ]);

        $club = Club::findOrFail($id);
        $club->update([
            'nama_klub' => $request->nama_klub,
            'kota_klub' => $request->kota_klub,
        ]);

        return redirect()->route('clubs.index')->with('success', 'Klub berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $club = Club::findOrFail($id);
        $club->delete();
        return redirect()->route('clubs.index')->with('success', 'Klub berhasil dihapus.');
    }
}
