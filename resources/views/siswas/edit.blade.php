@extends('adminlte::page')
@section('title', 'Edit User')
@section('content_header')
    <h1 class="m-0 text-dark">Edit Guru</h1>
@stop
@section('content')
    <form action="{{route('siswas.update', $siswa)}}" method="post">
        @method('PUT')
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Nama lengkap" name="nama" value="{{$siswa->nama ?? old('Nama')}}">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail" placeholder="Masukkan Email" name="email" value="{{$siswa->email ?? old('email')}}">
                        @error('email') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Jenis Kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input"  {{ $siswa->jenis_kelamin=='Laki-Laki' ? "checked" : "" }}  @error('jenis_kelamin') is-invalid @enderror" value="Laki-Laki"  type="radio" name="jenis_kelamin">
                                <label class="form-check-label">Laki-Laki</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" {{ $siswa->jenis_kelamin=='Perempuan' ? "checked" : "" }} @error('jenis_kelamin') is-invalid @enderror"  value="Perempuan" type="radio" name="jenis_kelamin">
                                <label class="form-check-label">Perempuan</label>
                            </div>
                        @error('password') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Tempat Lahir</label>
                        <input type="text" class="form-control" id="exampleInputPassword"  placeholder="Tempat Lahir" name="tempat_lahir" value="{{$siswa->tempat_lahir ?? old('tempat_lahir')}}">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                            @php
                            $config = ['format' => 'DD/MM/YYYY'];
                            @endphp
                        <x-adminlte-input-date name="idDisabled" value="{{$siswa->tanggal_lahir ?? old('tanggal_lahir')}}" :config="$config" />
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword">Agama</label>
                            <div class="form-check">
                                <input class="form-check-input"  @error('agama') is-invalid @enderror" value="Islam"  type="radio" {{ $siswa->agama=='Islam' ? "checked" : "" }} name="agama">
                                <label class="form-check-label">Islam</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input"  @error('agama') is-invalid @enderror"  value="Kristen" type="radio" {{ $siswa->agama=='Kristen' ? "checked" : "" }} name="agama">
                                <label class="form-check-label">Kristen</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input"  @error('agama') is-invalid @enderror"  value="Katolik" type="radio" {{ $siswa->agama=='Katolik' ? "checked" : "" }} name="agama">
                                <label class="form-check-label">Katolik</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input"  @error('agama') is-invalid @enderror"  value="Hindu" type="radio" {{ $siswa->agama=='Hindu' ? "checked" : "" }} name="agama">
                                <label class="form-check-label">Hindu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input"  @error('agama') is-invalid @enderror"  value="Budha" type="radio" {{ $siswa->agama=='Budha' ? "checked" : "" }} name="agama">
                                <label class="form-check-label">Budha</label>
                            </div>
                        @error('password') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Alamat</label>
                        <input type="text" class="form-control" id="exampleInputPassword" placeholder="Alamat" name="alamat" value="{{$siswa->alamat ?? old('alamat')}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">No Hp</label>
                        <input type="text" class="form-control" id="exampleInputPassword" placeholder="No Handphone" name="hp" value="{{$siswa->hp ?? old('hp')}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Pilih Role</label>
                        @foreach($roles as $role)
                            <div class="custom-control custom-checkbox">
                                <input name="role[]" class="custom-control-input" type="checkbox" id="{{ $role->name }}" value="{{ $role->id }}" {{$user->getRoleNames()->contains($role->name) ? 'checked' : '' }}>
                                <label for="{{ $role->name }}" class="custom-control-label">{{ $role->name }}</label>
                            </div>
                        @endforeach
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
