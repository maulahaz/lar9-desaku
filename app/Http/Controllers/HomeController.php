<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Config;

class HomeController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $this->data['pageTitle'] = 'Beranda';

        //--Identitas Desa:
        $this->data['nmDesa'] = Config::where('key', 'nama')->first();
        $this->data['alamat'] = Config::where('key', 'alamat')->first();
        $this->data['telepon'] = Config::where('key', 'telepon')->first();
        $this->data['email'] = Config::where('key', 'email')->first();

        //--Statistik Desa:
        $this->data['jumlahPenduduk'] = DB::table('tbl_penduduk')->count();
        $this->data['jumlahKeluarga'] = DB::table('tbl_keluarga')->count();
        $this->data['jumlahDusun'] = DB::table('ref_dusun')->count();
        $desa = DB::table('ref_desa')->where('id_desa', '>', 0)->first();
        $this->data['luasDesa'] = $desa->luas_wilayah ?? 0;

        //--Berita Terbaru:
        $this->data['dtBerita'] = DB::table('tbl_berita')
            ->orderByDesc('waktu')
            ->limit(3)
            ->get();

        //--Halaman Statis (Sejarah, Visi & Misi, Demografi):
        $this->data['sejarah'] = DB::table('tbl_pages')->where('url', 'web/c_sejarah')->first();
        $this->data['visiMisi'] = DB::table('tbl_pages')->where('url', 'web/c_visimisi')->first();
        $this->data['demografi'] = DB::table('tbl_pages')->where('url', 'web/c_demografi')->first();

        return view('templates/edustage/master', $this->data);
    }

    public function storeKontak(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:50',
            'email' => 'nullable|email|max:50',
            'pesan' => 'required|max:2000',
        ]);

        DB::table('tbl_kontak')->insert([
            'nama' => $validated['nama'],
            'email' => $validated['email'] ?? null,
            'pesan' => $validated['pesan'],
            'waktu' => now(),
        ]);

        return redirect('/#kontak')->with('success', 'Terima kasih, pesan Anda sudah terkirim.');
    }
}
