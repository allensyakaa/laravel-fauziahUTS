<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Keahlian;
use App\Models\Pendidikan;
use App\Models\Pengalaman;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    private array $map = [
        'pengalaman' => Pengalaman::class,
        'pendidikan' => Pendidikan::class,
        'keahlian'   => Keahlian::class,
    ];

    public function store(Request $request, Biodata $biodata, string $tipe)
    {
        $rules = [
            'pengalaman' => [
                'periode'   => 'required|string|max:100',
                'posisi'    => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
            ],
            'pendidikan' => [
                'tahun'   => 'required|string|max:50',
                'sekolah' => 'required|string|max:255',
                'jurusan' => 'required|string|max:255',
            ],
            'keahlian' => [
                'nama' => 'required|string|max:100',
            ],
        ];

        abort_unless(isset($rules[$tipe]), 404);

        $biodata->{$tipe}()->create($request->validate($rules[$tipe]));

        return back()->with('success', ucfirst($tipe) . ' berhasil ditambahkan.');
    }

    public function destroy(string $tipe, int $id)
    {
        $model = $this->map[$tipe] ?? abort(404);
        $model::findOrFail($id)->delete();

        return back()->with('success', ucfirst($tipe) . ' berhasil dihapus.');
    }
}
