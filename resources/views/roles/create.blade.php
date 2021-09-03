@extends('adminlte::page')
@section('title', 'Tambah User')
@section('content_header')
    <h1 class="m-0 text-dark">Tambah Role</h1>
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Role</h3>
          </div>
          {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                            <strong>Permission:</strong>
                            <br/>
                              @foreach($permission as $value)
                              <label  class="checkbox-inline">{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name checkbox-inline')) }}
                              {{ $value->name }}</label>
                          @endforeach
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.card -->
      </div>
      {{-- <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Permision</h3>
          </div>


            <div class="card-body">

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <!-- /.card -->
      </div> --}}
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->

@stop
