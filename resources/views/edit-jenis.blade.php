@extends('template')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit Jenis Transaksi</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Edit Data {{ $jenisTransaksi->jenis_id }}
        </h6>
    </div>

    <div class="card-body">
        <form action="/edit-jenis/{{ $jenisTransaksi->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_transaksi">Nama Transaksi</label>
                <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" value="{{ $jenisTransaksi->nama_transaksi }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <div class="card-footer">
        <a href="/jenis" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
