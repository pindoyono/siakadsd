@extends('adminlte::page')
@section('title', 'jadwal kelas')
@section('content_header')
    <h1 class="m-0 text-dark">Data Jadwal</h1>
@stop
@section('content')
<div class="col-md-12">
    <div class="card">
        {{-- <div class="card-header">
            <a href="{{ route('jadwals.index') }}" class="btn btn-default btn-sm"><i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</a>
            <button type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target=".tambah-jadwal">
                <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Jadwal
            </button>
        </div> --}}
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Hari</th>
                    <th>Jadwal</th>
                    <th>Jam Pelajaran</th>
                    {{-- <th>Ruang Kelas</th> --}}
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwal as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->hari }}</td>
                    <td>
                        <h5 class="card-title">{{ $data->nama_mapel }}</h5>
                        <p class="card-text"><small class="text-muted">{{ $data->nama_guru }}</small></p>
                    </td>
                    <td>{{ $data->jam_mulai }} - {{ $data->jam_selesai }}</td>
                    {{-- <td>{{ $data->ruang->nama_ruang }}</td> --}}
                    {{-- <td>
                      <form action="{{ route('jadwals.destroy', $data->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <a href="{{ route('jadwals.edit',$data->id) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                        <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                      </form>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<div class="modal fade bd-example-modal-lg tambah-jadwal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Tambah Data Jadwal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{ route('jadwals.store') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="hari_id">Hari</label>
                  <select id="hari_id" name="hari_id" class="form-control @error('hari_id') is-invalid @enderror select2bs4">
                        <option value="">-- Pilih Hari --</option>
                      <option value="Senin"> Senin </option>
                      <option value="Selasa"> Selasa </option>
                      <option value="Rabu"> Rabu </option>
                      <option value="Kamis"> Kamis </option>
                      <option value="Jumat"> Jumat </option>
                      <option value="Sabtu"> Sabtu </option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="kelas_id">Kelas</label>
                  <select id="kelas_id" name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Kelas --</option>
                      @foreach ($kelas as $data)
                          <option value="{{ $data->id }}">{{ $data->nama }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="mapel_id">Kode Mapel</label>
                  <select id="mapel_id" name="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Kode Mapel --</option>
                      @foreach ($mapel as $data)
                          <option value="{{ $data->id }}">{{ $data->nama }}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="jam_selesai">Jam Selesai</label>
                    @php
                    $config = ['format' => 'H:m'];
                    @endphp
                    <x-adminlte-input-date name="jam_mulai" :config="$config" placeholder="Mulai">
                        <x-slot name="appendSlot">
                            <div class="input-group-text bg-gradient-danger">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-date>
                </div>
                <div class="form-group">
                  <label for="jam_selesai">Jam Selesai</label>
                  @php
                  $config1 = ['format' => 'H:m'];
                  @endphp
                  <x-adminlte-input-date name="jam_selesai" :config="$config1" placeholder="Selesai">
                      <x-slot name="appendSlot">
                          <div class="input-group-text bg-gradient-danger">
                              <i class="fas fa-calendar-alt"></i>
                          </div>
                      </x-slot>
                  </x-adminlte-input-date>
                </div>
                <div class="form-group">
                    <label for="guru_id">Guru Mapel</label>
                    <select id="guru_id" name="guru_id" class="form-control @error('guru_id') is-invalid @enderror select2bs4">
                        <option value="">-- Pilih Guru Mapel --</option>
                        @foreach ($guru as $data)
                            <option value="{{ $data->id }}">{{ $data->Nama }}</option>
                        @endforeach
                    </select>
                  </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
              <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Tambahkan</button>
          </form>
      </div>
      </div>
    </div>
  </div>
<!-- /.col -->
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataJadwal").addClass("active");
    </script>
@endsection
