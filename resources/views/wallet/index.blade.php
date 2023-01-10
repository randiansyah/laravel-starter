@extends('layouts.app')

@section('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
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
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h6>Transaksi berlangsung adalah tugas yang sedang dikerjakan</h6>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info alert-has-icon">
                                <div class="alert-icon"><i class="fas fa-solid fa-wallet"></i></div>
                                <div class="alert-body">
                                    <div class="alert-title">Transaksi Berlangsung | @rupiah($total )</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card card-success">
                        <div class="card-header ">
                            <div id="saldoCreate">
                            <button class="btn btn-info saldo-create" data-total="{{ $totalWallet }}" data-total-display="@rupiah($totalWallet)"  data-toggle="modal" data-target="#data-modal-saldo" >Tarik Saldo</button>
                            </div>
                            <div class="card-header-action">
            
                            <div id="virtualCreate">
                            <button class="btn btn-warning virtual-create"  data-toggle="modal" data-target="#data-modal-virtual" >Tambahkan no virtual</button>
                            </div>    
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success alert-has-icon">
                                <div class="alert-icon"><i class="fas fa-solid fa-wallet"></i></div>
                                <div class="alert-body">
                                    <div class="alert-title">Transaksi Selesai |  @rupiah($totalWallet )</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card">
              
                      <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Transaksi Berlangsung</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="success-tab" data-toggle="tab" href="#success" role="tab" aria-controls="success" aria-selected="false">Transaksi Selesai</a>
                          </li>
                     
                        </ul>
                        <div class="tab-content" id="myTabContent">
                          <div class="tab-pane fade active show" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                            <div class="card">
                    
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-bordered" id="">
                                            <thead>
                                                <tr>
                                                  
                                                    <th>
                                                        Nama Tugas
                                                    </th>
                                                    <th>
                                                      Saldo
                                                    </th>
                                                    <th>
                                                        Status
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                            $no = 1
                                            @endphp
        
                                            @foreach ($todo as $todos)
                                            <tr>
                                                <td><b>{{ $todos->name }}</b></td>
                                                <td><div class="badge badge-success"><b>@rupiah($todos->price )<b></div></td>
                                    
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
                                               
                                       
        
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                          </div>
                          <div class="tab-pane fade" id="success" role="tabpanel" aria-labelledby="success-tab">
                            <div class="card">
                    
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-bordered" id="">
                                            <thead>
                                                <tr>
                                                    <th>
                                                  Waktu Transaksi
                                                    </th>
                                                    <th>
                                                      Tipe
                                                    </th>
                                                    <th>
                                                      Sumber Penarikan
                                                      </th>
                                                    <th>
                                                     Jumlah
                                                    </th>
                                                    <th>
                                                        Keterangan
                                                       </th>
                                                       <th>
                                                        Status
                                                       </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                            $no = 1
                                            @endphp
        
                                            @foreach ($wallet as $wallets)
                                            <tr>
                                                <td><b>{{ date('d M Y h:i', strtotime($wallets->created_at)) }}</b></td>
                                               <td><b>{{ $wallets->type }}</b></td>
                                               <td><b>
                                                @php $todoList = $wallets->virtual_number()->get(); @endphp
                                       
                                       @foreach ($todoList as $t)
                                       {{ $t->virtual }} |   {{ $t->no_virtual }}
                                                 @endforeach
                                            </b></td>
                                               <td><div class="badge badge-success"><b>@rupiah($wallets->total)</b></div></td>
                                               <td><b>{{ $wallets->desc }}</b></td>
                                               <td> @if($wallets->status == 'paid' )
                                                <div class="badge badge-success"><b>{{ $wallets->status }}<b></div>
                            
                                                @else
                                                <div class="badge badge-info"><b>{{ $wallets->status }}<b></div>
                                                @endif
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
                    </div>
                  </div>

            </div>
        </div>
    </section>
    <div class="modal fade" tabindex="-1" role="dialog" id="data-modal-saldo">
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
                                <label>Pilih Penarikan</label>
                                <select class="form-control selectric @error('virtual') is-invalid @enderror"
                                    name="virtual" required>
                                    <option value=""> -- Pilih  --</option>
                                    @foreach ($virtual as $v)
                                        <option value="{{ $v->id }}"
                                            {{ collect(old('vritual'))->contains($v->name_virtual) ? 'selected' : '' }}>
                                            {{ $v->virtual }} - {{ $v->no_virtual }} - {{ $v->name_virtual }}</option>
                                    @endforeach
                                </select>
                                @error('virtual')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                                                    <div class="form-group">
                                <label>Total Saldo</label>
                                <input type="hidden" class="form-control total" name="total" autocomplete="off">        
                                <input type="text" class="form-control total_display" readonly autocomplete="off">        
                            </div>
                           </div>
                  
                
                    <div class="modal-footer bg-whitesmoke br">
                        @if($totalWallet < 1)
                        
                         @else
                         <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="fas fa-solid fa-wallet"></i> Tarik Saldo</button>
                     
                        @endif
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="data-modal-virtual">
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
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" />
                    <div class="modal-body">
                      <div class="id"></div>
                      <div class="form-group">
                        <label>Pilih Virtual</label>
                        <select class="form-control search" name="virtual" required>
                            <option value="dana">Dana</option>
                            <option value="Shopeepay">Shopeepay</option>
                            <option value="Ovo">Ovo</option>
                          </select>
                    </div>
                    <div class="form-group">
                        <label>nama</label>
                        <input type="text" class="form-control" autocomplete="off" name="name_virtual" required>        
                    </div>
                    <div class="form-group">
                        <label>No Telp</label>
                        <input type="text" class="form-control" autocomplete="off" name="no_virtual" required>        
                    </div>
                </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="fas fa-save"></i> Simpan</button>
               
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
$(document).ready(function() {
    $('table.display').DataTable();
} );

$('#saldoCreate').on('click', '.saldo-create',function(){
    let total = $(this).data('total');
    let total_display = $(this).data('total-display');
    $('.total').val(total);  
    $('.total_display').val(total_display);  
        $('.modal-title').html('Tarik Saldo');           
            $('#edit').remove();
            $('.modal-content form').prepend('<input id="edit" type="hidden" name="_method" value="post">');
            $('.modal-content form').attr('action', '{{ url('/wallet/') }}');
            
            $.ajax({
                type: 'get',
                url: '{{ url('/wallet/') }}',
                dataType: 'json',
                success: function(data) {
                    $('#total').val(data.wallet.total);
                    $('#virtual').val(data.wallet.virtual);
                  
                }
            });
        });

        $('#virtualCreate').on('click', '.virtual-create',function(){
              $('.modal-title').html('Tambah Data Virtual');           
            $('#edit').remove();
            $('.modal-content form').prepend('<input id="edit" type="hidden" name="_method" value="post">');
            $('.modal-content form').attr('action', '{{ url('/noVirtual/') }}');
            
            $.ajax({
                type: 'get',
                url: '{{ url('/noVirtual/') }}',
                dataType: 'json',
                success: function(data) {
                    $('#user_id').val(data.virtual.user_id);
                    $('#virtual').val(data.virtual.virtual);
                    $('#name_virtual').val(data.virtual.name_virtual);
                    $('#no_virtual').val(data.virtual.no_virtual);
                }
            });
        });

    </script>

    
@endsection
