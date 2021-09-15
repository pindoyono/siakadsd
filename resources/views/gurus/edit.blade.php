@extends('adminlte::page')
@section('title', 'Edit User')
@section('content_header')
    <h1 class="m-0 text-dark">Edit Guru</h1>
@stop
@section('content')
    <form action="{{route('gurus.update', $guru)}}" method="post">
        @method('PUT')
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Nama lengkap" name="Nama" value="{{$guru->Nama ?? old('Nama')}}">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail" placeholder="Masukkan Email" name="email" value="{{$guru->email ?? old('email')}}">
                        @error('email') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Jenis Kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input"  {{ $guru->jenis_kelamin=='Laki-Laki' ? "checked" : "" }}  @error('jenis_kelamin') is-invalid @enderror" value="Laki-Laki"  type="radio" name="jenis_kelamin">
                                <label class="form-check-label">Laki-Laki</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" {{ $guru->jenis_kelamin=='Perempuan' ? "checked" : "" }} @error('jenis_kelamin') is-invalid @enderror"  value="Perempuan" type="radio" name="jenis_kelamin">
                                <label class="form-check-label">Perempuan</label>
                            </div>
                        @error('password') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Tempat Lahir</label>
                        <input type="text" class="form-control" id="exampleInputPassword"  placeholder="Tempat Lahir" name="tempat_lahir" value="{{$guru->tempat_lahir ?? old('tempat_lahir')}}">
                    </div>
                        <div class="form-group">
                        <label>Tanggal Lahir</label>
                            @php
                            $config = ['format' => 'DD/MM/YYYY'];
                            @endphp
                        <x-adminlte-input-date name="idDisabled" value="{{$guru->tanggal_lahir ?? old('tanggal_lahir')}}" :config="$config" />
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword">Agama</label>
                            <div class="form-check">
                                <input class="form-check-input"  @error('agama') is-invalid @enderror" value="Islam"  type="radio" {{ $guru->agama=='Islam' ? "checked" : "" }} name="agama">
                                <label class="form-check-label">Islam</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input"  @error('agama') is-invalid @enderror"  value="Kristen" type="radio" {{ $guru->agama=='Kristen' ? "checked" : "" }} name="agama">
                                <label class="form-check-label">Kristen</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input"  @error('agama') is-invalid @enderror"  value="Katolik" type="radio" {{ $guru->agama=='Katolik' ? "checked" : "" }} name="agama">
                                <label class="form-check-label">Katolik</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input"  @error('agama') is-invalid @enderror"  value="Hindu" type="radio" {{ $guru->agama=='Hindu' ? "checked" : "" }} name="agama">
                                <label class="form-check-label">Hindu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input"  @error('agama') is-invalid @enderror"  value="Budha" type="radio" {{ $guru->agama=='Budha' ? "checked" : "" }} name="agama">
                                <label class="form-check-label">Budha</label>
                            </div>
                        @error('password') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Alamat</label>
                        <input type="text" class="form-control" id="exampleInputPassword" placeholder="Alamat" name="alamat" value="{{$guru->alamat ?? old('alamat')}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">No Hp</label>
                        <input type="text" class="form-control" id="exampleInputPassword" placeholder="No Handphone" name="hp" value="{{$guru->hp ?? old('hp')}}">
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('gurus.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
