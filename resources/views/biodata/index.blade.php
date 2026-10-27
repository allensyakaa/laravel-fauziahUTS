
@extends('layouts.app')
@section('title', 'Daftar Biodata')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h4 class="mb-3">Daftar Biodata</h4>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $i => $row)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                @if ($row->foto)
                                    <img src="{{ asset('storage/' . $row->foto) }}" width="60" height="60" style="object-fit:cover;" alt="foto">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->jabatan }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->telepon }}</td>
                            <td>
                                <a href="{{ route('biodata.show', $row) }}" class="btn btn-info btn-sm">Lihat CV</a>
                                <a href="{{ route('biodata.edit', $row) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('biodata.destroy', $row) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
