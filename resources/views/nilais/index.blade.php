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
                                <option value="">Pilih Guru Pengajar</option>
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
