@extends('adminlte::page')
@section('title', 'List User')
@section('content_header')
<div class="row">
    <div class="col-md-8"><h1 class="m-0 text-dark">Anggota Kelas {{$rombel->nama }}</h1></div>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Anggota Kelas
                  </h3>
                </div>
                <form action="{{route('rombels.anggota', $rombel->id)}}" method="post">
                    @csrf
                    <div class="card-body pad table-responsive">
                        <div  class="form-group">
                            <select name='anggota[]' class="duallistbox" multiple="multiple">
                                @foreach($anggota as $key => $agg)
                                    <option  selected value="{{$agg->id}}">{{$agg->nama}}</option>
                                @endforeach
                                @foreach($non_anggota as $key => $non_agg)
                                    <option  value="{{$non_agg->id}}" >{{$non_agg->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input name='id_rombel' value='' type="hidden">
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
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($anggota as $key => $agg)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$agg->nama}}</td>
                                <td>
                                    <a href="{{route('rombels.keluar',$agg->id)}}" class="btn btn-danger btn-xs">
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
