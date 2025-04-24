@extends('template')
@section('content')
{{-- Custom Alert --}}
@if ($errors->any())
<div class="alert alert-danger">
    <div class="card-body">
        Error : {{ $errors->first() }}
    </div>
</div>
@endif
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
{{-- / Custom Alert --}}
<h1 class="h3 mb-4 text-gray-800">Edit Pemasukan</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Data
            {{ $transaksi->transaksi_id }}</h6>
    </div>
    <div class="card-body">
        <form action="/edit-pemasukan/{{ $transaksi->id }}"
            enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Jenis Transaksi</label><br>
                <select class="form-control" id="jenis_id"
                    name="jenis_id" required>
                    @foreach ($jenises as $jenis)
                    <option value="{{ $jenis->id }}" {{
                        $transaksi->jenis_id == $jenis->id ? 'selected' : '' }}>
                        {{ $jenis->jenis_id . ' - ' . $jenis->nama_transaksi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Sumber Dana</label><br>
                <select class="form-control" id="id_sumberdana"
                    name="id_sumberdana" required>
                    @foreach ($sumberdanas as $sumber)
                    <option value="{{ $sumber->id }}" {{
                        $transaksi->id_sumberdana == $sumber->id ? 'selected' : '' }}>
                        {{ $sumber->id . ' - ' . $sumber->sumber }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Status</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input"
                        type="radio" name="status" id="lunas"
                        {{ $transaksi->status == 1 ?: 'checked' }}
                        value="1">
                    <label class="form-check-label"
                        for="lunas">Lunas</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input"
                        type="radio" name="status" id="belumLunas"
                        {{ $transaksi->status == 0 ?: 'checked' }}
                        value="0">
                    <label class="form-check-label"
                        for="belumLunas">Belum Lunas</label>
                </div>
            </div>
            {{-- / Radio Button --}}
            <div class="form-group">
                <label for="nominal">Nominal</label>
                <input type="number" class="form-control"
                    value="{{ $transaksi->nominal }}" id="nominal"
                    name="nominal" required>
            </div>
            <div class="form-group">
                <label for="catatan">Catatan</label>
                <textarea class="form-control" id="catatan"
                    name="catatan" rows="3" required>{{ $transaksi->catatan }}
                </textarea>
            </div>
            <div class="form-group">
                <label for="file">File Baru</label>
                <input type="file" class="form-control-file"
                    id="file" name="fileDokumen"
                    accept=".jpg,.png,.jpeg,.pdf">
                <a href="/uploads/{{ $transaksi->file }}"
                    target="_blank">File Sebelumnya : {{ $transaksi->file }}</a>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <div class="card-footer">
        <a href="/transaksi/pemasukan/1" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
