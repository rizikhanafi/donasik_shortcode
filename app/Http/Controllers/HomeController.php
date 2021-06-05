<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Donatur;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $jumlah_donasi = Donatur::where('status','=','Terverifikasi')->sum('jumlah_donasi');
        $jumlah_donatur = Donatur::where('status','=','Terverifikasi')->get()->count();
        $tampil = DB::table('donatur')->orderByDesc('dibuat_tanggal')->limit(10)->get();
        return view('home',compact('tampil','jumlah_donatur','jumlah_donasi'));
    }
}
