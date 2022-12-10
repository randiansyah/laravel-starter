@extends('layouts.app')

@section('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ $pageTitle }}</h1>
    </div>

    @if(session('message'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            {{ session('message') }}
        </div>
    </div>
    @endif

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
          
                        @can('task-create')
                        <div class="card-header-action">
                            <a href="{{ url('task/create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i></a>
                        </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                  Nama Tugas
                                        </th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1
                                    @endphp

                                    @foreach ($task as $tasks)
                                    <tr>
                      
                                        <td>{{ $tasks->name }}</td>
                                        <td>
                                            @can('task-update')
                                            <a href="{{ url('/task/' .$tasks->id. '/edit') }}" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                                            @endcan
                                            @can('task-delete')
                                            <button class="btn btn-icon btn-danger delete-task" data-toggle="modal" data-target="#data-modal-delete" data-id="{{ $tasks->id }}"><i class="fas fa-times"></i></button>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="data-modal-delete">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="#">
                @method('delete')
                @csrf
                <div class="modal-body">
                    <p>Apakah Anda yakin akan menghapus data ini?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-danger btn-shadow">Ya</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- JS Libraies -->
<script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
<script>
    $('#datatable').on('click', '.delete-task', function() {
        let id = $(this).data('id');

        $('.modal-title').html('Hapus Data Kategori');
        $('.modal-content form').attr('action', '{{ url('/task/') }}/' +id);
    });
</script>
@endsection