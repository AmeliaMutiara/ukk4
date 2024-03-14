@extends('adminlte::page')

@section('title', 'Penjualan')

@section('content_header')
    <h1>Tambah Data Penjualan</h1>
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
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input name="tglPenjualan" disabled label="Tanggal Penjualan" value="{{ date('d-m-Y', strtotime($penjualan->tglPenjualan)) }}" />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="namaPelanggan" disabled label="Nama Pelanggan" value="{{ $penjualan->pelanggan->namaPelanggan ?? 'Pembeli' }}" />
                </div>
            </div>
        </div>
    </div>
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar Pembelian
            </h5>
            <div class="form-actions float-right">
                <a href="{{ route('sales.index') }}" name="Find" class="btn btn-sm btn-primary" title="Back">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Produk</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Subtotal</th>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                            $total = 0;
                        @endphp
                        @if (empty($penjualan->detail))
                            <tr>
                                <td colspan="6" class="text-center">Data Kosong</td>
                            </tr>
                        @else
                            @foreach ($penjualan->detail as $k => $v)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td>{{ $v->produk->namaProduk }}</td>
                                    <td class="text-right">{{ number_format($v->produk->harga) }}</td>
                                    <td class="text-center">{{ $v->jmlProduk }}</td>
                                    <td class="text-right">{{ number_format($v->subtotal,2) }}</td>
                                </tr>
                                @php
                                    $total += ($v->subtotal)
                                @endphp
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-center font-weight-bold">Total</td>
                            <td class="text-right">{{ number_format($total,2) }}</td>
                        </tr>
                    </tfoot>
                </table>
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