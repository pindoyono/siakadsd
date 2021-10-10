@extends('adminlte::page')
@section('title', 'List User')
@section('content_header')
    <h1 class="m-0 text-dark">List Kelas</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('rombels.create')}}" class="btn btn-primary mb-2">
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Tingkat</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rombels as $key => $rombel)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$rombel->nama}}</td>
                                <td>{{$rombel->tingkat}}</td>
                                <td>
                                    <a href="{{route('rombels.edit',$rombel)}}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <a href="{{route('rombels.show',$rombel)}}" class="btn btn-success btn-xs">
                                        <i class="fas fa-search-plus"></i>
                                        Anggota Rombel
                                    </a>
                                    <a href="{{route('rombels.pembelajaran',$rombel)}}" class="btn btn-info btn-xs">
                                        <i class="fas fa-search-plus"></i>
                                        Pembelajaran
                                    </a>
                                    <a href="{{route('rombels.destroy',$rombel)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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
