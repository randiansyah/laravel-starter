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

        @if (session('message'))
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
                    
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Nama Tugas
                                            </th>
                                            <th>
                                                Biaya yang di dapat
                                            </th>
                                            @role('administrator')
                                            <th>
                                                nama
                                            </th>
                                            <th>
                                                image
                                            </th>
                                            <th>
                                                image1
                                            </th>
                                            <th>
                                                Deskripsi
                                            </th>
                                            @endrole
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                    $no = 1
                                    @endphp

                                    @foreach ($todo as $todos)
                                    <tr>
                                        <td><div class="badge badge-warning"><b>{{ $todos->status }}<b></div></td>
                                        <td><b>{{ $todos->name }}</b></td>
                                        <td><div class="badge badge-success"><b>@rupiah($todos->price )<b></div></td>
                                            @role('administrator')
                                            <td> {{ $todos->namanya }}</td>
                                            <td>
                                                <div class="gallery gallery-fw" data-item-height="60">
                                                    <div class="gallery-item" data-image="{{ asset('images/upload/'.$todos->image) }}" data-title="Image 1"></div>
                                           </div>
                                            </td>
                                            <td>
                                                <div class="gallery gallery-fw" data-item-height="60">
                                                    <div class="gallery-item" data-image="{{ asset('images/upload/'.$todos->image1) }}" data-title="Image 1"></div>
                                           </div>
                                            </td>
                                            <td> {!! $todos->description !!}</td>
                                       @endrole  
                                        <td>

                                            @can('todo-read')
                                            <button class="btn btn-icon btn-danger todo-update" data-toggle="modal" data-target="#data-modal-eye"  data-id="{{ $todos->id }}"><i class="fas fa-edit"> </i> Update</button>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="data-modal-eye">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="#">
                    @csrf
                    <div class="modal-body">
                      <div class="id"></div>
                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control search" name="status" required>
                            <option value="revisi">Revisi</option>
                            <option value="success">Berhasil</option>
                            <option value="failed">Gagal</option>
                          </select>
                    </div>
                    <div class="form-group">
                        <label>Pesan</label>
                        <textarea class="form-control" rows="135px" cols="135px" name="comment"></textarea>
                    </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="fas fa-save"></i> Simpan</button>
               
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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

        $('#datatable').on('click', '.todo-update',function(){
            let id = $(this).data('id');

            $('.modal-title').html('Ubah Data Tugas ');  
            $('#edit').remove();
            $('.modal-content form').prepend('<input id="edit" type="hidden" name="_method" value="patch">');
            $('.modal-content form').attr('action', '{{ url('/permissions/') }}/' +id);
            
            $.ajax({
                type: 'get',
                url: '{{ url('/permissions/') }}/' +id,
                dataType: 'json',
                success: function(data) {
                    $('#nama').val(data.permission.name);
                }
            });
        });


    </script>
@endsection
