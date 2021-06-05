<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donatur;
use DB;

class DonasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function donasi() {
        return view('donasi');
    }

    public function tambahdonasi(Request $req) {
        $validation = $req->validate([
            'id_donatur' => 'nullable',
            'nama_donatur' => 'required',
            'email' => 'required',
            'no_telepon' => 'required|regex:/^\d+(\.\d{1,2})?$/|min:12|max:13',
            'jumlah_donasi' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'dibuat_tanggal' => 'nullable',
            'status' => 'required',
        ]);
        Donatur::create($validation);
        return redirect()->route('donasis')->with('pesan','Data sukes disimpan, jangan lupa kirim bukti pembayaran untuk verifikasi.');
    }

    public function donatur() {

        $tampil = DB::table('donatur')->orderByDesc('dibuat_tanggal')->get();
        return view('admin/donatur', compact('tampil'));
    }

    public function ubah($id_donatur) {
        $data = Donatur::where('id_donatur', $id_donatur)->get();

        return view('admin/editdonatur', compact('data'));
    }

    public function update(Request $req) {
        $validation = $req->validate([
            'id_donatur' => 'nullable',
            'nama_donatur' => 'required',
            'email' => 'required',
            'no_telepon' => 'required|regex:/^\d+(\.\d{1,2})?$/|min:12|max:13',
            'jumlah_donasi' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'dibuat_tanggal' => 'nullable',
            'status' => 'required',

        ]);

       Donatur::find($req -> id_donatur)->update($validation);
        return redirect()->route('donaturs')->with('pesan','Data berhasil di ubah.');

    }

    public function hapus(Request $req) {
        Donatur::find($req -> id_donatur)->delete();
        return redirect()->route('donaturs')->with('pesan', 'Data berhasil di hapus.');
    }

    public function detail_profil() {
        return view('detailprofil');
    }

    public function edit_profil() {
        return view('editprofil');
    }

    public function update_profil() {
        Request()->validate([
            'ids' => 'nullable',
            'nama' => 'required',
            'email' => 'required',
        ]);

        $data = [
            'id' => Request()->ids,
            'name' => Request()->nama,
            'email' => Request()->email,
        ];
        $id = auth()->user()->id;
        DB::table('users')->where ('id', $id)->update($data);
        return redirect()->route('detailprofil');
    }

}
