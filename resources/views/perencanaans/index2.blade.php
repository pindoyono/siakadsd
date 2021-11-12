@extends('adminlte::page')
@section('title', 'List User')
@section('content_header')
    <h1 class="m-0 text-dark">Daftar Nilai Siswa</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="row" action="{{route('nilais.sort')}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="col-sm-9">
                        <!-- checkbox -->
                        <div class="form-group">
                            <select class=" select2" name="id_relasi" style="width: 100%;">
                                <option value=0>Pilih Guru Pengajar</option>
                                @foreach($mapel as $key => $map)
                                <option value="{{$map->id_relasi}}">{{ $map->nama_mapel.'   ==>  '.$map->nama_rombel}}</option>
                                {{-- <option {{ $map->id == $gur->mapel_id ? 'selected' : '' }} value="{{$gur->id}}">{{  $map->id.'dan'.$gur->mapel_id  }}</option> --}}
                                @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="col-sm-3">
                        <!-- radio -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th width="40%">Nilai</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($mapel2 as $key => $map)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        {{$map->nama}}
                                    </td>
                                    <td>
                                        {{$map->nama_rombel}}
                                    </td>
                                    <td>
                                        <form class="row" action="{{route('nilais.sort2')}}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <div class="col-sm-6">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputPassword" value="{{getNilai($map->id_mapel,$map->id)}}" placeholder="Tempat Lahir" name="nilai" >
                                                <input type="hidden" class="form-control" id="exampleInputPassword"  name="id_mapel" value="{{$map->id_mapel}}" >
                                                <input type="hidden" class="form-control" id="exampleInputPassword"  name="id_siswa" value="{{$map->id}}">
                                                <input type="hidden" class="form-control" id="exampleInputPassword"  name="id_relasi" value="{{$map->id_relasi}}">
                                            </div>
                                            </div>
                                            <div class="col-sm-3">
                                            <!-- radio -->
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@push('js')
    <script>
         $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })

        $('#example2').DataTable({
            "responsive": true,
        });
        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }


    </script>
@endpush
