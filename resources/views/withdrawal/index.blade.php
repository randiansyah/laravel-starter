@extends('layouts.app')

@section('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <!-- image -->
    <link rel="stylesheet" href="{{ asset('assets/modules/chocolat/dist/css/chocolat.css') }}">
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
        </div>

        @if ($message = session()->has('message'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session()->get('message') }}
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ $errors->first() }}
                </div>
            </div>
        @endif



        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>  Status </th>
                                            <th>  Nama User </th>
                                            <th>  Virtual </th>
                                            <th>  Jumlah </th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp

                                        @foreach ($wallet as $w)
                                            <tr>
                                                <td>
                                                    @if ($w->status == 'paid')
                                                        <div class="badge badge-success"><b>{{ $w->status }}<b></div>
                                                    @else
                                                        <div class="badge badge-info"><b>{{ $w->status }}<b></div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @php $users = $w->user()->first(); @endphp
                                                    <b>{{ $users->name }}</b>
                                                </td>
                                                <td><b>
                                                        @php $todoList = $w->virtual_number()->get(); @endphp

                                                        @foreach ($todoList as $t)
                                                            {{ $t->virtual }} | {{ $t->no_virtual }} |
                                                            {{ $t->name_virtual }}
                                                        @endforeach
                                                    </b></td>

                                                <td>
                                                    <div class="badge badge-success"><b>@rupiah($w->total)<b></div>
                                                </td>

                                                <td>
                                                    @role('administrator')
                                                        <button class="btn btn-icon btn-danger update" data-toggle="modal"
                                                            data-target="#data-modal-update" data-id="{{ $w->id }}"><i
                                                                class="fas fa-edit"></i></button>
                                                    @endrole
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

    <div class="modal fade" tabindex="-1" role="dialog" id="data-modal-update">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="#">
                    @method('patch')
                    @csrf
                    <div class="modal-body">
                        <p>Apakah Anda yakin ?</p>
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
    <!-- image -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>


    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
    <script>
        // $('#datatable').on('click', '.todo-update', function() {
        //     let id = $(this).data('id');
        //     $('.id').html(id);
        //     $('.modal-title').html('Update data');
        //     $('.modal-content form').attr('action', '{{ url('/todo/') }}/' + id);
        // });

    
        $('#datatable').on('click', '.update', function() {
        let id = $(this).data('id');

        $('.modal-title').html('Ubah Status menjadi berhasil');
        $('.modal-content form').attr('action', '{{ url('/wallet/') }}/' + id);
    });
    </script>
@endsection
