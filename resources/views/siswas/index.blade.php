@extends('adminlte::page')
@section('title', 'List User')
@section('content_header')
    <h1 class="m-0 text-dark">List Siswa</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('siswas.create')}}" class="btn btn-primary mb-2">
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>No Hp</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($siswas as $key => $siswa)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$siswa->nama}}</td>
                                <td>{{$siswa->email}}</td>
                                <td>{{$siswa->jenis_kelamin}}</td>
                                <td>{{$siswa->tempat_lahir}}</td>
                                <td>{{$siswa->tanggal_lahir}}</td>
                                <td>{{$siswa->agama}}</td>
                                <td>{{$siswa->alamat}}</td>
                                <td>{{$siswa->hp}}</td>
                                <td>
                                    <a href="{{route('siswas.edit', $siswa)}}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <a href="{{route('siswas.destroy', $siswa)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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
