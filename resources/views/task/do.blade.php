@extends('layouts.app')

@section('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/chocolat/dist/css/chocolat.css') }}">
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('/task') }}">Tugas</a></div>
                <div class="breadcrumb-item active">Tugas Baru</div>
            </div>
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
            <div class="alert alert-primary alert-has-icon p-4">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                  <div class="alert-title"><b>{{ $task->name  }}</b></div>
                  <p>Biaya yang akan kamu dapatkan setelah mengerjakan tugas sebesar.</p>

                  <p class="mt-3">
                    <a href="#" class="btn bg-white text-dark"><b><i class="fas fa-dollar"></i> @rupiah($task->price) </b></a>
                  </p>
                  
                </div>
              </div>
              <div class="card">
              <div class="card-header">
                <h4>Deskripsi tugas</h4>
              </div>
              <div class="card-body">
                {!! $task->description !!}.
              </div>
              <div class="card-header">
                <h4>Kirim bukti setelah tugas selesai tugas</h4>
              </div>
              <div class="card-body">
                <div class="col-12 col-md-12">
                    <form method="POST" action="{{ url('/todo/') }}" class="needs-validation" novalidate=""  enctype="multipart/form-data">
                  <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" />
                  <input type="hidden" value="{{ $task->id }}" name="task_id" />
                  <input type="hidden" value="{{ $task->price }}" name="price" />
                    <div class="form-group row">
                      <div class="col-6 col-md-6">
                        <label>SS photo 1 seperti gambar dibawah ini :</label>
                        {{-- <img src="{{ asset('images/1671692888.Screenshot_2.png') }}"> --}}
                        <div class="gallery gallery-fw" data-item-height="250">
                          <div class="gallery-item" data-image="{{ asset('images/'.$task->image) }}" data-title="Image 1"></div>
                 </div>
                      </div>
                      <div class="col-6 col-md-6">
                        <label>Upload photo disini :</label>
                        <input type="file" name="image" class="form-control" required>
                      </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-6 col-md-6">
                          <label>SS photo 2 seperti gambar dibawah ini :</label>
                          {{-- <img src="{{ asset('images/1671692888.Screenshot_2.png') }}"> --}}
                          <div class="gallery gallery-fw" data-item-height="250">
                            <div class="gallery-item" data-image="{{ asset('images/'.$task->image) }}" data-title="Image 1"></div>
                   </div>
                        </div>
                        <div class="col-6 col-md-6">
                          <label>Upload photo disini :</label>
                          <input type="file" name="image1" class="form-control" required>
                        </div>
                        </div>
                      <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="summernote-simple" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-icon icon-left btn-primary"><i
                                class="fas fa-send"></i> Kirim</button>
                    </div>

                    </form>
                </div>
              </div>
            </div>
          </div>

    </section>
@endsection

@section('script')
    <!-- JS Libraies -->
    <script src="{{ asset('assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/auth-register.js') }}"></script>
    <script src="{{ asset('assets/modules/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endsection
