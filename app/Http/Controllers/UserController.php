<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(UserDataTable $table)
    {
        if (Auth::user()->level) {
            return $table->render('User.index');
        } else {
            return redirect()->route('user.edit', Auth::id());
        }
    }

    public function create()
    {
        $level = [
            0 => 'Petugas',
            1 => 'Admin'
        ];
        return view('User.add', compact('level'));
    }

    public function update($id)
    {
        $level = [
            0 => 'Petugas',
            1 => 'Admin'
        ];

        if (is_null($id)) {
            $id = Auth::id();
        } elseif (!Auth::user()->level) {
            $id = Auth::id();
        }
        
        $data = User::find($id);
        return view('User.edit', compact('data', 'level'));
    }

    public function processCreate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'level' => 'required'
        ], [
            'name.required' => 'Kolom Nama User Harus Terisi',
            'password.required' => 'Kolom Password Harus Terisi',
            'level.required' => 'Kolom Level Harus Dipilih',
        ]);

        try {
            DB::beginTransaction();
            User::create($request->all());
            DB::commit();
            return redirect()->route('user.index')->with(['msg' => 'Berhasil Menambahkan Data User', 'type' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            report($e);
            return redirect()->route('user.add')->with(['msg' => 'Gagal Menambahkan Data User', 'type' => 'danger']);
        }
    }

    public function processUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'level' => 'required'
        ], [
            'name.required' => 'Kolom Nama User Harus Terisi',
            'level.required' => 'Kolom Level Harus Dipilih',
        ]);

        try {
            DB::beginTransaction();
            $id = $request->id;
            if (!Auth::user()->level&&$request->id!=Auth::id()) {
                $id = Auth::id();
            }

            $user = User::find($id);
            if (is_null($request->password)) {
                $user->update($request->except('password', 'id'));
            } else {
                $user->update($request->except('id'));
            }

            DB::commit();
            return redirect()->route('user.index')->with(['msg' => 'Berhasil Mengubah Data User', 'type' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return redirect()->route('user.edit')->with(['msg' => 'Gagal Mengubah Data User', 'type' => 'danger']);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            User::find($id)->delete();
            DB::commit();
            return redirect()->route('user.index')->with(['msg' => 'Berhasil Menghapus Data User', 'type' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return redirect()->route('user.index')->with(['msg' => 'Gagal Menghapus Data User', 'type' => 'danger']);
        }
    }
}
