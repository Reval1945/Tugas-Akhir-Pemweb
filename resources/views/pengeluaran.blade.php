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

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-info ">Pengeluaran</h6>
            </div>
            <div class="col-md-4 text-right">
                <a class="btn btn-primary mb-1" data-toggle="modal" data-target="#addModal">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                <a class="btn btn-primary" href="/cetakpengeluaran" target="_blank">
                    <i class="fas fa-print"></i> Cetak Data
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id</th>
                        <th>Sumber Dana</th>
                        <th>Status</th>
                        <th>Jenis</th>
                        <th>Nominal</th>
                        <th>Catatan</th>
                        <th>File</th>
                        <th>Dibuat Pada</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengeluaran as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->transaksi_id }}</td>
                            <td>
                                {{ $data->sumber }}<br>
                                @if ($data->logo != '')
                                    <img src="{{ asset('uploads/' . $data->logo) }}" alt="Logo Image" width="100">
                                @else
                                    No image
                                @endif
                            </td>
                            <td>{{ $data->status == 1 ? 'Lunas' : 'Belum Lunas' }}</td>
                            <td>{{ $data->nama_transaksi }}</td>
                            <td>{{ $data->nominal }}</td>
                            <td>{{ $data->catatan }}</td>
                            <td><a href="/uploads/{{ $data->file }}">{{ $data->file }}</a></td>
                            <td>{{ $data->created_at }}</td>
                            <td>
                            <div class="d-flex gap-1">
                                <a href="/pengeluaran/edit/{{ $data->id }}" class="btn btn-sm btn-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="/delete-pengeluaran/{{ $data->id }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete {{ $data->transaksi_id }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="/add-pengeluaran" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Dropdown Jenis --}}
                    <div class="form-group">
                        <label>Jenis Transaksi</label>
                        <select class="form-control" id="jenis_id" name="jenis_id" required>
                            @foreach ($jenises as $jenis)
                                <option value="{{ $jenis->id }}">{{ $jenis->jenis_id . ' - ' . $jenis->nama_transaksi }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Dropdown Sumber Dana --}}
                    <div class="form-group">
                        <label>Sumber Dana</label>
                        <select class="form-control" id="id_sumberdana" name="id_sumberdana" required>
                            @foreach ($sumberdanas as $sumber)
                                <option value="{{ $sumber->id }}">{{ $sumber->id . ' - ' . $sumber->sumber }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Radio Button --}}
                    <div class="form-group">
                        <label>Status</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="lunas" value="1">
                            <label class="form-check-label" for="lunas">Lunas</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="belumLunas" value="0">
                            <label class="form-check-label" for="belumLunas">Belum Lunas</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="number" class="form-control" id="nominal" name="nominal" required>
                    </div>

                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" class="form-control-file" id="file" name="file" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
<!-- Page level plugins -->
<script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('#jenis_id').select2({
            dropdownParent: $('#addModal')
        });
        $('#id_sumberdana').select2({
            dropdownParent: $('#addModal')
        });
    });
</script>
@endsection
