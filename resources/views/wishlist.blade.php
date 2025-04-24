@extends('template')

@section('content')
<!-- Data Wishlist -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center">
            <div class="col-md-10">
                <h3 class="m-0 font-weight-bold text-primary">Wishlist</h3>
            </div>
            <div class="col">
                <a class="btn btn-success" data-toggle="modal" data-target="#addModal">
                    <i class="fas fa-upload"></i> Upload Excel
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Wishlist</th>
                        <th>Nama Wishlist</th>
                        <th>Link Olshop</th>
                        <th>Target Beli</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kode Wishlist</th>
                        <th>Nama Wishlist</th>
                        <th>Link Olshop</th>
                        <th>Target Beli</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->kode_wishlist }}</td>
                            <td>{{ $data->nama_wishlist }}</td>
                            <td>{{ $data->link_olshop }}</td>
                            <td>{{ $data->target_beli }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Upload Excel -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Data Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="/upload-excel" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="fileExcel">Pilih File Excel</label>
                        <input type="file" class="form-control" id="fileExcel" name="fileExcel" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- DataTables Plugins -->
<script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>
@endsection
