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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row align-items-center">
                <div class="col-md-10">
                    <h3 class="m-0 font-weight-bold text-primary">Sumber Dana</h3>
                </div>
                <div class="col">
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
                            <th>Sumber</th>
                            <th>Logo</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Sumber</th>
                            <th>Logo</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->sumber }}</td>
                                <td>
                                    @if ($data->logo != '')
                                        <img src="{{ asset('uploads/' . $data->logo) }}" alt="Logo Image" width="100">
                                    @else
                                        No image
                                    @endif
                                </td>
                                <td>{{ $data->created_at }}</td>
                                <td>{{ $data->updated_at }}</td>
                                <td>
                                    {{-- Buat Tombol Edit dan Delete --}}
                                    <a href="{{ url('/sumber-dana/edit/' . $data->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ url('/sumber-dana/delete/' . $data->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
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
                    <form action="/add-sumber" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="sumber_dana">Sumber Dana</label>
                            <input type="text" class="form-control" id="sumber_dana" name="sumber_dana" required>
                        </div>

                        <div class="form-group">
                            <label for="logo">Logo <small class="text-muted">(opsional)</small></label>
                            <input type="file" class="form-control-file" id="logo" name="logo" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
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
    <!-- Page level plugins -->
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>
@endsection
