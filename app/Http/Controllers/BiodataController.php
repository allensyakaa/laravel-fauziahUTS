<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    public function index()
    {
        $data = Biodata::latest()->get();
        return view('biodata.index', compact('data'));
    }

    public function create()
    {
        return view('biodata.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto', 'public');
        }

        Biodata::create($validated);

        return redirect()->route('biodata.index')
            ->with('success', 'Biodata berhasil ditambahkan.');
    }

    public function show(Biodata $biodata)
    {
        $biodata->load(['pengalaman', 'pendidikan', 'keahlian']);
        return view('biodata.show', compact('biodata'));
    }

    public function edit(Biodata $biodata)
    {
        return view('biodata.edit', compact('biodata'));
    }

    public function update(Request $request, Biodata $biodata)
    {
        $validated = $request->validate($this->rules());

        if ($request->hasFile('foto')) {
            if ($biodata->foto) {
                Storage::disk('public')->delete($biodata->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto', 'public');
        }

        $biodata->update($validated);

        return redirect()->route('biodata.index')
            ->with('success', 'Biodata berhasil diperbarui.');
    }

    public function destroy(Biodata $biodata)
    {
        if ($biodata->foto) {
            Storage::disk('public')->delete($biodata->foto);
        }
        $biodata->delete();

        return redirect()->route('biodata.index')
            ->with('success', 'Biodata berhasil dihapus.');
    }

    private function rules(): array
    {
        return [
            'nama'         => 'required|string|max:255',
            'jabatan'      => 'required|string|max:255',
            'telepon'      => 'required|string|max:30',
            'instagram'    => 'nullable|string|max:100',
            'email'        => 'required|email|max:255',
            'alamat'       => 'required|string|max:255',
            'tentang_saya' => 'nullable|string',
            'kesukaan'     => 'nullable|string',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
