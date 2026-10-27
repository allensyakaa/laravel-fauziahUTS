@php $b = $biodata ?? null; @endphp

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama', $b->nama ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Jabatan / Profesi</label>
        <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $b->jabatan ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Telepon</label>
        <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $b->telepon ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Instagram / Website</label>
        <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $b->instagram ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $b->email ?? '') }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Alamat</label>
        <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $b->alamat ?? '') }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Tentang Saya</label>
        <textarea name="tentang_saya" rows="4" class="form-control">{{ old('tentang_saya', $b->tentang_saya ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Kesukaan (pisahkan dengan koma)</label>
        <input type="text" name="kesukaan" class="form-control"
               value="{{ old('kesukaan', $b->kesukaan ?? '') }}"
               placeholder="Kuliner, Berwisata, Bersepeda">
    </div>
    <div class="col-12">
        <label class="form-label">Foto Profil</label>
        @if ($b && $b->foto)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $b->foto) }}" width="120" alt="foto">
            </div>
        @endif
        <input type="file" name="foto" class="form-control" accept="image/*">
        <small class="text-muted">Format JPG/PNG/WEBP, maksimal 2 MB.</small>
    </div>
</div>
