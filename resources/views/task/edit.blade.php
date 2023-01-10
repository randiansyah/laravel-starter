@extends('layouts.app')

@section('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/dist/summernote-bs4.css') }}">
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('/task') }}">Tugas</a></div>
                <div class="breadcrumb-item active">Tambah Data Tugas</div>
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
            <div class="row">
                <div class="col-12 col-md-2"></div>
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ubah Tugas</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('/task/'.$task->id) }}" class="needs-validation" novalidate=""  enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input value="{{ $task->name }}" autocomplete="off" name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control selectric @error('category') is-invalid @enderror"
                                        name="category">
                                        <option value=""> -- Pilih Kategori --</option>
                                        @foreach ($category as $c)
                                            <option value="{{ $c->id }}" {{ $c->id == $task->category ? 'selected' : '' }}>
                                                {{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="summernote-simple" name="description" value="{{ $task->description }}">{{ $task->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Catatan</label>
                                    <input value="{{ $task->notes }}" autocomplete="off" name="notes" type="text"
                                        class="form-control @error('notes') is-invalid @enderror"
                                        value="{{ old('notes') }}">
                                    @error('notes')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Biaya</label>
                                    <input value="{{ $task->price }}" autocomplete="off" name="price" type="number"
                                        class="form-control  @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}">
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Batas Waktu</label>
                                    <input value="{{ $task->deadline }}" autocomplete="off" name="deadline" type="number"
                                        class="form-control @error('limit') is-invalid @enderror"
                                        value="{{ old('deadline') }}">
                                    @error('deadline')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Peserta</label>
                                    <input value="{{ $task->limit }}" autocomplete="off" name="limit" type="number"
                                        class="form-control @error('limit') is-invalid @enderror"
                                        value="{{ old('limit') }}">
                                    @error('limit')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Image 1</label>
                                    <input type="file" name="image" class="form-control">
                                    <input type="hidden" value="{{ $task->image }}" name="image_value">
                                    <input type="hidden" value="{{ $task->path_image }}" name="path_image">
                                  </div>
                                  <div class="form-group">
                                    <label>Image 2</label>
                                    <input type="file" name="image1"  class="form-control">
                                    <input type="hidden" value="{{ $task->image1 }}" name="image_value1">
                                    <input type="hidden" value="{{ $task->path_image1 }}" name="path_image1">
                                  </div>
                                  <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                      <option value="active" {{$task->status == 'active' ? 'selected' : '' }}>Aktif</option>
                                      <option value="inactive" {{$task->status == 'inactive' ? 'selected' : '' }}>Non Aktif</option>
                                    </select>
                                  </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-icon icon-left btn-primary"><i
                                            class="fas fa-save"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
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

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/auth-register.js') }}"></script>
    <script src="{{ asset('assets/modules/summernote/dist/summernote-bs4.js') }}"></script>
@endsection
