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
            @if($errors->any())
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                {{$errors->first()}}
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
                                        <td>
                                            @if($todos->status == 'revisi' )
                                            <div class="badge badge-warning"><b>{{ $todos->status }}<b></div>
                                            @elseif($todos->status == 'success')
                                            <div class="badge badge-success"><b>{{ $todos->status }}<b></div>
                                            @elseif($todos->status == 'failed')
                                            <div class="badge badge-danger"><b>{{ $todos->status }}<b></div>
                                            @else
                                            <div class="badge badge-info"><b>{{ $todos->status }}<b></div>
                                            @endif
                                            
                              
                                            </td>
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
                                            @role('administrator')
                                            <button class="btn btn-icon btn-danger todo-update" data-toggle="modal" data-target="#data-modal-eye" data-user_id="{{ $todos->user_id }}" data-task_id="{{ $todos->task_id }}" data-price="{{ $todos->price }}"  data-id="{{ $todos->id }}"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-icon btn-light todo-comment" data-toggle="modal" data-target="#data-modal-comment" data-comment="{{ $todos->comment }}"  data-id="{{ $todos->id }} "><i class="far fa-envelope"> </i> Lihat</button>
                                     
                                            @endrole  
                                            @role('User')
                                            @if($todos->status == 'revisi' )
                                            <button class="btn btn-icon btn-light todo-comment" data-toggle="modal" data-target="#data-modal-comment" data-comment="{{ $todos->comment }}"  data-id="{{ $todos->id }} "><i class="far fa-envelope"> </i> Lihat</button>
                                            <a href="{{ url('/task/' .$todos->task_id. '/do') }}" class="btn btn-icon btn-success" Title="Kerjakan"><i class="fas fa-solid fa-paper-plane"></i></a>
                                            @elseif($todos->status == 'failed' )
                                            <button class="btn btn-icon btn-light todo-comment" data-toggle="modal" data-target="#data-modal-comment" data-comment="{{ $todos->comment }}"  data-id="{{ $todos->id }} "><i class="far fa-envelope"> </i> Lihat</button>
                                            @elseif($todos->status == 'pending' )
                                            <a href="{{ url('/task/' .$todos->task_id. '/do') }}" class="btn btn-icon btn-success" Title="Kerjakan"><i class="fas fa-solid fa-paper-plane"></i></a>
                                      
                                            @endif

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

    <div class="modal fade" tabindex="-1" role="dialog" id="data-modal-comment">
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
                 
                    <div class="form-group">
                        <label>Pesan</label>
                        <textarea class="form-control comment" style="height: 157px;" name="comment"></textarea>
                    </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                     
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                      <input type="hidden" class="form-control" id="user_id" name="user_id">
                      <input type="hidden" class="form-control" id="price" name="price">
                      <input type="hidden" class="form-control" id="task_id" name="task_id">
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
            let price = $(this).data('price');
            let task_id = $(this).data('task_id');
            let user_id = $(this).data('user_id');
            $('#user_id').val(user_id);  
            $('#price').val(price);  
            $('#task_id').val(task_id);  
            $('.modal-title').html('Ubah Data Tugas ');  
            $('#edit').remove();
            $('.modal-content form').prepend('<input id="edit" type="hidden" name="_method" value="patch">');
            $('.modal-content form').attr('action', '{{ url('/todo/') }}/' +id);
            
            $.ajax({
                type: 'get',
                url: '{{ url('/todo/') }}/' +id,
                dataType: 'json',
                success: function(data) {
                    $('#user_id').val(data.todo.user_id);
                    $('#task_id').val(data.todo.task_id);
                    $('#price').val(data.todo.price);
                    $('#status').val(data.todo.status);
                    $('#comment').val(data.todo.comment);
                }
            });
        });

        $('#datatable').on('click', '.todo-comment',function(){
            let id = $(this).data('id');
            let comment = $(this).data('comment');
            $('.comment').html(comment);  
            $('.modal-title').html('Lihat Pesan');  
              
         
        });


    </script>
@endsection
