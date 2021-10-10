@extends('adminlte::page')
@section('title', 'List User')
@section('content_header')
<div class="row">
    <div class="col-md-8"><h1 class="m-0 text-dark">Pembelajaran Kelas {{$rombel->nama }}</h1></div>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Pembelajaran Kelas
                  </h3>
                </div>
                <form action="{{route('rombels.mapel', $rombel->id)}}" method="post">
                    @csrf
                    <div class="card-body pad table-responsive">
                        <div  class="form-group">
                            <select name='mapel[]' class="duallistbox" multiple="multiple">
                                @foreach($mapel as $key => $map)
                                    <option  selected value="{{$map->id}}">{{$map->nama}}</option>
                                @endforeach
                                @foreach($all_mapel as $key => $all_map)
                                    <option  value="{{$all_map->id}}" >{{$all_map->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('rombels.index')}}" class="btn btn-default">
                            Batal
                        </a>
                    </div>
                </form>
                <!-- /.card -->
              </div>
        </div>
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Anggota Kelas
                  </h3>
                </div>
                <div class="card-body pad table-responsive">
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Pengajar</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($mapel as $key => $map)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$map->nama}}</td>
                                <td>
                                        <form class="row" action="{{route('rombels.set_guru',$map)}}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <div class="col-sm-9">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <select class=" select2" name="guru_id" style="width: 100%;">
                                                    <option value="">Pilih Guru Pengajar</option>
                                                    @foreach($guru as $key => $gur)
                                                        <option {{ $map->id == $gur->mapel_id ? 'selected' : '' }} value="{{$gur->id}}">{{ $gur->Nama}}</option>
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
                                </td>
                                <td>
                                    <a href="{{route('rombels.keluar2',$map->id)}}" class="btn btn-danger btn-xs">
                                        keluar
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card -->
              </div>
        </div>
    </div>
@stop
@push('js')
    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>
    <script>
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
         //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox();

        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }


    </script>
@endpush
