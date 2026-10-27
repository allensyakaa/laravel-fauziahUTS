@extends('layouts.app')
@section('title', 'Edit Biodata')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h4 class="mb-3">Edit Biodata</h4>
        <form action="{{ route('biodata.update', $biodata) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('biodata.form')
            <div class="mt-4">
                <button class="btn btn-primary">Perbarui</button>
                <a href="{{ route('biodata.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
