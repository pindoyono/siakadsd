@extends('adminlte::page')
@section('title', 'List User')
@section('content_header')
    <h1 style="float:left;" class="m-0 text-dark">Daftar Nilai Siswa</h1>
    <a style="margin-left:100px" href="{{route('laporans.cetak',$id_siswa)}}" target='_blank' class="btn btn-success btn-md">
        <i class="fas fa-file"></i>
        cetak
    </a>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Mapel</th>
                            <th>Nilai</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($mapel as $key => $map)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        {{$map->nama_mapel}}
                                    </td>
                                    <td >
                                        {{
                                            getNilai($map->id_mapel,$id_siswa)
                                        }}
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
