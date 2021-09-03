@extends('adminlte::page')
@section('title', 'Tambah User')
@section('content_header')
    <h1 class="m-0 text-dark">Tambah User</h1>
@stop
@section('content')
    <form action="{{route('gurus.store')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Nama lengkap" name="Nama" value="{{old('name')}}">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail" placeholder="Masukkan Email" name="email" value="{{old('email')}}">
                        @error('email') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Jenis Kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input"  @error('jenis_kelamin') is-invalid @enderror" value="Laki-Laki"  type="radio" name="jenis_kelamin">
                                <label class="form-check-label">Laki-Laki</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input"  @error('jenis_kelamin') is-invalid @enderror"  value="Permepuan" type="radio" name="jenis_kelamin">
                                <label class="form-check-label">Perempuan</label>
                            </div>
                        @error('password') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Tempat Lahir</label>
                        <input type="text" class="form-control" id="exampleInputPassword" placeholder="Konfirmasi Password" name="tempat_lahir">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Tanggal Lahir</label>
                        <input type="text" class="form-control" id="exampleInputPassword" placeholder="Konfirmasi Password" name="tanggal_lahir">
                    </div>
                    <div class="form-group">
                        <label>Date:</label>
                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                      </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('users.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

<script>

    $('#reservationdate').datetimepicker({
        format: 'L'
    });
</script>
