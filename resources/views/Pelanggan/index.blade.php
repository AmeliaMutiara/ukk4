@extends('adminlte::page')

@section('title', 'Pelanggan')

@section('content_header')
    <h1>Daftar Pelanggan</h1>
@stop

@section('content')
    @if (session('msg'))
        <div class="alert alert-{{ session('type') ?? 'info' }}" role="alert">
            {{ session('msg') }}
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert-danger" role="alert">
            @foreach ($errors->all() as $e)
                {{ $e }}
            @endforeach
        </div>
    @endif
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <a href="{{ route('customer.add') }}" name="Find" class="btn btn-sm btn-primary" title="Add Data">
                    <i class="fa fa-plus"></i> Tambah Data
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{ $dataTable->table() }}
                @push('js')
                    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
                @endpush
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script></script>
@stop

@section('footer')
    this page still created and practicing
@stop