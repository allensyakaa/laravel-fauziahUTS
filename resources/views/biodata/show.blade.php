@extends('layouts.app')
@section('title', 'CV ' . $biodata->nama)

@section('content')
<style>
    .cv-box { background: #fff; padding: 2rem; margin-bottom: 1rem; font-weight: 600; }
    .cv-photo { width: 100%; max-width: 260px; aspect-ratio: 1/1; object-fit: cover; background: #ccc; }
    .cv-name { font-weight: 900; letter-spacing: 1px; text-transform: uppercase; font-size: 2.6rem; }
    .cv-title { border-top: 3px solid #000; display: inline-block; padding-top: .5rem; font-size: 1.3rem; }
    .cv-heading { letter-spacing: 6px; font-weight: 800; text-transform: uppercase; font-size: 1.1rem;
                  border-bottom: 3px solid #000; padding-bottom: .5rem; margin-bottom: 1rem; }
    .item-del { border: 0; background: none; color: #dc3545; font-weight: 700; }
</style>

<div class="d-print-none mb-3">
    <a href="{{ route('biodata.index') }}" class="btn btn-secondary btn-sm">&larr; Kembali</a>
    <a href="{{ route('biodata.edit', $biodata) }}" class="btn btn-warning btn-sm">Edit</a>
    <button onclick="window.print()" class="btn btn-dark btn-sm">Cetak / Simpan PDF</button>
</div>

{{-- HEADER --}}
<div class="cv-box">
    <div class="row align-items-center">
        <div class="col-md-4 mb-3 mb-md-0">
            @if ($biodata->foto)
                <img src="{{ asset('storage/' . $biodata->foto) }}" class="cv-photo" alt="foto">
            @else
                <div class="cv-photo d-flex align-items-center justify-content-center text-muted">Tidak ada foto</div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="cv-name">{{ $biodata->nama }}</div>
            <div class="cv-title mb-3">{{ $biodata->jabatan }}</div>
            <div>{{ $biodata->telepon }}</div>
            @if ($biodata->instagram) <div>{{ $biodata->instagram }}</div> @endif
            <div>{{ $biodata->email }}</div>
            <div>{{ $biodata->alamat }}</div>
        </div>
    </div>
</div>

<div class="cv-box">
    {{-- TENTANG SAYA --}}
    <div class="cv-heading">Tentang Saya</div>
    <p>{{ $biodata->tentang_saya ?: '-' }}</p>

    <div class="row mt-5">
        {{-- PENGALAMAN --}}
        <div class="col-md-6">
            <div class="cv-heading">Pengalaman</div>
            @forelse ($biodata->pengalaman as $p)
                <div class="mb-4">
                    <ul class="mb-1"><li>{{ $p->periode }}</li></ul>
                    <div>{{ $p->posisi }}</div>
                    <div class="mt-2">{{ $p->deskripsi }}</div>
                    <form action="{{ route('item.destroy', ['pengalaman', $p->id]) }}" method="POST"
                          class="d-print-none" onsubmit="return confirm('Hapus pengalaman ini?')">
                        @csrf @method('DELETE')
                        <button class="item-del">Hapus</button>
                    </form>
                </div>
            @empty
                <p class="text-muted">Belum ada pengalaman.</p>
            @endforelse
        </div>

        {{-- PENDIDIKAN + KEAHLIAN --}}
        <div class="col-md-6">
            <div class="cv-heading">Pendidikan</div>
            @forelse ($biodata->pendidikan as $e)
                <div class="mb-4">
                    <div>{{ $e->tahun }}</div>
                    <div>{{ $e->sekolah }}</div>
                    <div>{{ $e->jurusan }}</div>
                    <form action="{{ route('item.destroy', ['pendidikan', $e->id]) }}" method="POST"
                          class="d-print-none" onsubmit="return confirm('Hapus pendidikan ini?')">
                        @csrf @method('DELETE')
                        <button class="item-del">Hapus</button>
                    </form>
                </div>
            @empty
                <p class="text-muted">Belum ada pendidikan.</p>
            @endforelse

            <div class="cv-heading mt-5">Keahlian</div>
            <ul>
                @forelse ($biodata->keahlian as $k)
                    <li>
                        {{ $k->nama }}
                        <form action="{{ route('item.destroy', ['keahlian', $k->id]) }}" method="POST"
                              class="d-inline d-print-none">
                            @csrf @method('DELETE')
                            <button class="item-del">x</button>
                        </form>
                    </li>
                @empty
                    <li class="text-muted">Belum ada keahlian.</li>
                @endforelse
            </ul>
        </div>
    </div>

    {{-- KESUKAAN --}}
    <div class="cv-heading mt-4">Kesukaan</div>
    <ul><li>{{ $biodata->kesukaan ?: '-' }}</li></ul>
</div>

{{-- FORM TAMBAH DATA (tidak ikut tercetak) --}}
<div class="card shadow-sm d-print-none">
    <div class="card-body">
        <h5 class="mb-3">Kelola Data CV</h5>
        <div class="row g-4">

            <div class="col-md-4">
                <h6>Tambah Pengalaman</h6>
                <form action="{{ route('item.store', [$biodata, 'pengalaman']) }}" method="POST">
                    @csrf
                    <input type="text" name="periode" class="form-control mb-2" placeholder="Januari 2019 - Januari 2020" required>
                    <input type="text" name="posisi" class="form-control mb-2" placeholder="Posisi / Jabatan" required>
                    <textarea name="deskripsi" rows="3" class="form-control mb-2" placeholder="Deskripsi"></textarea>
                    <button class="btn btn-primary btn-sm">Tambah</button>
                </form>
            </div>

            <div class="col-md-4">
                <h6>Tambah Pendidikan</h6>
                <form action="{{ route('item.store', [$biodata, 'pendidikan']) }}" method="POST">
                    @csrf
                    <input type="text" name="tahun" class="form-control mb-2" placeholder="2018 - 2022" required>
                    <input type="text" name="sekolah" class="form-control mb-2" placeholder="Nama sekolah/universitas" required>
                    <input type="text" name="jurusan" class="form-control mb-2" placeholder="Jurusan" required>
                    <button class="btn btn-primary btn-sm">Tambah</button>
                </form>
            </div>

            <div class="col-md-4">
                <h6>Tambah Keahlian</h6>
                <form action="{{ route('item.store', [$biodata, 'keahlian']) }}" method="POST">
                    @csrf
                    <input type="text" name="nama" class="form-control mb-2" placeholder="Contoh: Fotografi" required>
                    <button class="btn btn-primary btn-sm">Tambah</button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
