@extends('adminlte::page')
@section('title', 'Edit User')
@section('content_header')
    <h1 class="m-0 text-dark">Edit Mapel</h1>
@stop
@section('content')
    <form action="{{route('mapels.update', $mapel)}}" method="post">
        @method('PUT')
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="exampleInputName" placeholder="Nama Mata Pelajaran" name="nama" value="{{$mapel->nama ?? old('nama')}}">
                        @error('nama') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Kelompok Mata Pelajaran</label>
                        <select name="kelompok" class="custom-select">
                          <option  {{ $mapel->kelompok=='Kelompok A' ? "selected" : "" }} value="Kelompok A">Kelompok A</option>
                          <option  {{ $mapel->kelompok=='Kelompok B' ? "selected" : "" }} value="Kelompok B">Kelompok B</option>
                          {{-- <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option> --}}
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUrut">Urutan Mata Pelajaran</label>
                        <input type="number" id="replyNumber" min="0" data-bind="value:replyNumber"  class="form-control @error('no_urut') is-invalid @enderror" placeholder="Urutan pada rapor" name="no_urut"  value="{{$mapel->no_urut ?? old('no_urut')}}">
                        @error('no_urut') <span class="text-danger">{{$message}}</span> @enderror
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
