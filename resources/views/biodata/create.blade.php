@extends('layouts.app')
@section('title', 'Tambah Biodata')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h4 class="mb-3">Tambah Biodata</h4>
        <form action="{{ route('biodata.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('biodata.form')

            <div class="mt-4">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('biodata.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
