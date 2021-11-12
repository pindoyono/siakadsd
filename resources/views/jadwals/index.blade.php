@extends('adminlte::page')
@section('title', 'Tambah User')
@section('content_header')
    <h1 class="m-0 text-dark">Tambah Guru</h1>
@stop
@section('content')

<div class="col-md-12">
    <div class="card">
      <div class="card-header">
          <h3 class="card-title">

              {{-- <a href="{{ route('jadwal.export_excel') }}" class="my-3 btn btn-success btn-sm" target="_blank"><i class="nav-icon fas fa-file-export"></i> &nbsp; EXPORT EXCEL</a>
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#importExcel">
                  <i class="nav-icon fas fa-file-import"></i> &nbsp; IMPORT EXCEL
              </button>
              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#dropTable">
                  <i class="nav-icon fas fa-minus-circle"></i> &nbsp; Drop
              </button> --}}
          </h3>
      </div>
      <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form method="post" action="" enctype="multipart/form-data">

            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
              </div>
              <div class="modal-body">
                @csrf
                  <div class="card card-outline card-primary">
                      <div class="card-header">
                          <h5 class="modal-title">Petunjuk :</h5>
                      </div>
                      <div class="card-body">
                          <ul>
                              <li>rows 1 = nama hari</li>
                              <li>rows 2 = nama kelas</li>
                              <li>rows 3 = nama mapel</li>
                              <li>rows 4 = nama guru</li>
                              <li>rows 5 = jam mulai</li>
                              <li>rows 6 = jam selesai</li>
                              <li>rows 7 = nama ruang</li>
                          </ul>
                      </div>
                  </div>
                  <label>Pilih file excel</label>
                  <div class="form-group">
                    <input type="file" name="file" required="required">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Import</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Kelas</th>
                    <th>Lihat Jadwal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas as $data)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>
                      <a href="{{route('jadwals.lihat',$data->id)}}" class="btn btn-info btn-sm"><i class="nav-icon fas fa-search-plus"></i> &nbsp; Ditails</a>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
{{-- <div class="modal fade bd-example-modal-lg tambah-jadwal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
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
  </div> --}}
@stop

