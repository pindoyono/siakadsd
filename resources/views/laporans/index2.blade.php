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
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th width="40%">Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa as $key => $sis)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        {{$sis->nama}}
                                    </td>
                                    <td>
                                        {{$sis->nama_rombel}}
                                    </td>
                                    <td>
                                        <a href="{{route('laporans.show',$sis->id)}}" class="btn btn-primary btn-xs">
                                            <i class="fas fa-search-plus"></i>
                                            Lihat
                                        </a>
                                        <a href="{{route('laporans.cetak',$sis->id)}}" target='_blank' class="btn btn-success btn-xs">
                                            <i class="fas fa-file"></i>
                                            cetak
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
