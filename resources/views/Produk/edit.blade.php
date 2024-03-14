@extends('adminlte::page')

@section('title', 'Produk')

@section('content_header')
    <h1>Edit Data Produk</h1>
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
                Edit
            </h5>
            <div class="form-actions float-right">
                <a href="{{ route('product.index') }}" name="Find" class="btn btn-sm btn-primary" title="Back">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <form action="{{ route('product.edit-process') }}" method="post">
            <div class="card-body">
                @csrf
                <div class="row">
                    <x-adminlte-input name="id" type="hidden" value="{{ $data->id }}" disable-feedback />
                    <x-adminlte-input name="namaProduk" label="Nama Produk" value="{{ $data->namaProduk }}" placeholder="Masukkan Nama Produk"
                        fgroup-class="col-md-4 required" disable-feedback />
                    <x-adminlte-input name="harga" type="number" label="Harga Produk" value="{{ $data->harga }}" placeholder="Masukkan Harga Produk"
                        fgroup-class="col-md-4 required" disable-feedback />
                    <x-adminlte-input name="stok" type="number"  label="Stok Produk" value="{{ $data->stok }}" placeholder="Masukkan Stok Produk"
                        fgroup-class="col-md-4 required" disable-feedback />
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="forms-actions float-right">
                    <x-adminlte-button class="btn" type="reset" label="Reset" theme="danger" icon="fas fa-trash" />
                    <x-adminlte-button class="btn" type="submit" label="Submit" theme="success"
                        onclick="$(this).addClass('disabled');$('form').submit();" icon="fas fa-save" />
                </div>
            </div>
        </form>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop

@section('footer')
    this page still created and practicing
@stop