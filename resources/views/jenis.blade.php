@extends('template')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
    <div class="row align-items-center">
        <div class="col-md-10">
            <h3 class="m-0 font-weight-bold text-info">Jenis Transaksi</h3>
        </div>
        <div class="col">
            <!-- Tombol untuk membuka modal -->
            <a class="btn btn-success" data-toggle="modal" data-target="#addModal">Tambah Data</a>
        </div>
    </div>
</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->nama_transaksi }}</td>
                            <td>{{ $data->created_at }}</td>
                            <td>{{ $data->updated_at }}</td>
                            <td>
                                <a href="/jenis/edit/{{ $data->id }}" class="btn btn-primary">Edit</a>
                                <form action="/delete-jenis/{{$data->id}}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete {{ $data->jenis_id }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" value="{{ $data->id }}" name="id" id="id" />
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

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
                <form action="/add-jenis" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_transaksi">Nama Transaksi</label>
                        <input
                            type="text"
                            class="form-control"
                            id="nama_transaksi"
                            name="nama_transaksi"
                            required
                        >
                    </div>
                    <!-- Tambahkan field lain jika diperlukan -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                >
                    Close
                </button>
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
@endsection
