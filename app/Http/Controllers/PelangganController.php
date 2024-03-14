<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\PelangganDataTable;
use Illuminate\Support\Facades\Session;

use function PHPSTORM_META\type;

class PelangganController extends Controller
{
    public function index(PelangganDataTable $table)
    {
        Session::forget('data-pelanggan');
        return $table->render('Pelanggan.index');
    }

    public function create()
    {
        $sessiondata = Session::get('data-pelanggan');
        return view('Pelanggan.add', compact('sessiondata'));
    }

    public function update($id)
    {
        $sessiondata = Session::get('data-pelanggan');
        $data = Pelanggan::find($id);
        return view('Pelanggan.edit', compact('sessiondata', 'data'));
    }

    public function processCreate(Request $request)
    {
        $request->validate([
            'namaPelanggan' => 'required',
            'noTelp' => 'required',
            'alamat' => 'required'
        ], [
            'namaPelanggan.required' => 'Kolom Nama Pelanggan Harus Terisi',
            'noTelp.required' => 'Kolom Nomor Telepon Harus Terisi',
            'alamat.required' => 'Kolom Alamat Harus Terisi',
        ]);

        try {
            DB::beginTransaction();
            Pelanggan::create($request->all());
            DB::commit();
            return redirect()->route('customer.index')->with(['msg' => 'Berhasil Menambahkan Data Pelanggan', 'type' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return redirect()->route('customer.add')->with(['msg' => 'Gagal Menambahkan Data Pelanggan', 'type' => 'danger']);
        }
    }

    public function processUpdate(Request $request)
    {
        $request->validate([
            'namaPelanggan' => 'required',
            'noTelp' => 'required',
            'alamat' => 'required'
        ], [
            'namaPelanggan.required' => 'Kolom Nama Pelanggan Harus Terisi',
            'noTelp.required' => 'Kolom Nomor Telepon Harus Terisi',
            'alamat.required' => 'Kolom Alamat Harus Terisi',
        ]);

        try {
            DB::beginTransaction();
            Pelanggan::find($request->id)->update($request->except('id'));
            DB::commit();
            return redirect()->route('customer.index')->with(['msg' => 'Berhasil Mengubah Data Pelanggan', 'type' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return redirect()->route('customer.edit')->with(['msg' => 'Gagal Mengubah Data Pelanggan', 'type' => 'danger']);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            Pelanggan::find($id)->delete();
            DB::commit();
            return redirect()->route('customer.index')->with(['msg' => 'Berhasil Menghapus Data Pelanggan', 'type' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return redirect()->route('customer.index')->with(['msg' => 'Gagal Menghapus Data Pelanggan', 'type' => 'danger']);
        }
    }
}
