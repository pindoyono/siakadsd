@extends('adminlte::page')
@section('title', 'List Perencanaan')
@section('content_header')
    <h1 class="m-0 text-dark">List Perencanaan</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('perencanaans.create')}}" class="mb-2 btn btn-primary">
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Nama Penilaian</th>
                            <th>Bobot</th>
                            <th>opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($perencanaan as $key => $rencana)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{getMapel($rencana->id_mapel)}}</td>
                                <td>{{getRombel($rencana->id_rombel)}}</td>
                                <td>{{$rencana->nama_penilaian}}</td>
                                <td>{{$rencana->bobot}}</td>
                                <td>
                                    <a href="{{route('perencanaans.edit', $rencana)}}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <a href="{{route('perencanaans.destroy',$rencana)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                        Delete
                                    </a>
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
