@extends('adminlte::page')
@section('title', 'Tambah User')
@section('content_header')
    <h1 class="m-0 text-dark">Tambah Guru</h1>
@stop
@section('content')
    <form action="{{route('siswas.store')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Nama lengkap" name="nama" value="{{old('name')}}">
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
                                <input class="form-check-input"  @error('jenis_kelamin') is-invalid @enderror"  value="Perempuan" type="radio" name="jenis_kelamin">
                                <label class="form-check-label">Perempuan</label>
                            </div>
                        @error('password') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Tempat Lahir</label>
                        <input type="text" class="form-control" id="exampleInputPassword" placeholder="Tempat Lahir" name="tempat_lahir">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        @php
                        $config = ['format' => 'L'];
                        @endphp
                        <x-adminlte-input-date name="tanggal_lahir" :config="$config" placeholder="Tanggal Lahir...">
                            <x-slot name="appendSlot">
                                <div class="input-group-text bg-gradient-danger">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-date>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword">Agama</label>
                            <div class="form-check">
                                <input class="form-check-input"  @error('agama') is-invalid @enderror" value="Islam"  type="radio" name="agama">
                                <label class="form-check-label">Islam</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input"  @error('agama') is-invalid @enderror"  value="Kristen" type="radio" name="agama">
                                <label class="form-check-label">Kristen</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input"  @error('agama') is-invalid @enderror"  value="Katolik" type="radio" name="agama">
                                <label class="form-check-label">Katolik</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input"  @error('agama') is-invalid @enderror"  value="Hindu" type="radio" name="agama">
                                <label class="form-check-label">Hindu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input"  @error('agama') is-invalid @enderror"  value="Budha" type="radio" name="agama">
                                <label class="form-check-label">Budha</label>
                            </div>
                        @error('password') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Alamat</label>
                        <input type="text" class="form-control" id="exampleInputPassword" placeholder="Alamat" name="alamat">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">No Hp</label>
                        <input type="text" class="form-control" id="exampleInputPassword" placeholder="No Handphone" name="hp">
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('siswas.index')}}" class="btn btn-default">
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
