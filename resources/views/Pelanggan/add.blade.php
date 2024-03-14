@extends('adminlte::page')

@section('title', 'Pelanggan')

@section('content_header')
    <h1>Tambah Data Pelanggan</h1>
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
                Tambah
            </h5>
            <div class="form-actions float-right">
                <a href="{{ route('customer.index') }}" name="Find" class="btn btn-sm btn-primary" title="Back">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <form action="{{ route('customer.add-process') }}" method="post">
            <div class="card-body">
                @csrf
                <div class="row">
                    <x-adminlte-input name="namaPelanggan" label="Nama Pelanggan" value="{{ $sessiondata['namaPelanggan'] ?? '' }}" placeholder="Masukkan Nama Pelanggan"
                        fgroup-class="col-md-6 required" disable-feedback />
                    <x-adminlte-input name="noTelp" label="Nomor Telepon" value="{{ $sessiondata['noTelp'] ?? '' }}" placeholder="Masukkan Nomor Telepon"
                        fgroup-class="col-md-6 required" disable-feedback />
                    <x-adminlte-textarea name="alamat" label="Alamat" fgroup-class="col-md-12 required" placeholder="Masukkan Alamat..." />
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    <x-adminlte-button class="btn" type="reset" label="Reset" theme="danger" icon="fas fa-trash" />
                    <x-adminlte-button class="btn" type="submit" label="Submit" theme="success"
                        onclick="$(this).addClass('disabled');$('form').submit();" icon="fas fa-save" />
                </div>
            </div>
        </form>
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