@extends('adminlte::page')
@section('title', 'Tambah Perencanaan')
@section('content_header')
    <h1 class="m-0 text-dark">Tambah Perencanaan</h1>
@stop
@section('content')
    <form action="{{route('perencanaans.store')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="rombel" class="col-sm-5 control-label">Mata Pelajaran</label>
                            <select name="id_mapel" class="select2 form-control col-sm-5 auto_width" id="rombel" tabindex="-1" aria-hidden="true">
                                <option value="">== Pilih Mata Pelajaran ==</option>
                                @foreach($mapel as $map)
                                    <option value="{{$map->id_mapel}}">{{ $map->nama_mapel }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="mapel" class="col-sm-5 control-label">Rombongan Belajar</label>
                            <select  name="id_rombel" class="select2 form-control col-sm-5 auto_width" id="mapel" tabindex="-1" aria-hidden="true">
                                <option value="">== Pilih Rombongan Belajar ==</option>
                                @foreach($rombel as $rom)
                                <option value="{{$rom->id_rombel}}">{{ $rom->nama_rombel }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName">Nama Penilaian</label>
                        <input type="text" class="form-control col-sm-5 @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Nama Penilaian" name="nama_penilaian" value="{{old('nama_penialaian')}}">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName">Bobot</label>
                        <input type="text" class="form-control col-sm-5 @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Bobot" name="bobot" value="{{old('bobot')}}">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
            </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('perencanaans.index')}}" class="btn btn-default">
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
