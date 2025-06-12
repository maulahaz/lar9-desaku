<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keuangan;

class KeuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->data['webTitle'] = env('APP_WEB_TITLE');
    }

    public function index(Request $request)
    {
        $this->data['pageTitle'] = 'Data Keuangan';

        if ($request->has('reset')) {
            return redirect()->route('admin.keuangan.index');
        }

        $sort = $request->input('sort', 'tanggal');
        $direction = $request->input('direction', 'desc');
        $query = Keuangan::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('kategori', 'LIKE', "%{$searchTerm}%")
                ->orWhere('keterangan', 'LIKE', "%{$searchTerm}%");
        }

        $keuangans = $query->orderBy($sort, $direction)->paginate(20);

        $this->data['keuangans'] = $keuangans;
        $this->data['sort'] = $sort;
        $this->data['direction'] = $direction;
        $this->data['search'] = $request->input('search', '');

        return view('admin.keuangan.index', $this->data);
    }

    public function create()
    {
        $this->data['pageTitle'] = 'Tambah Data Keuangan';
        $this->data['keuangan'] = new Keuangan();

        return view('admin.keuangan.form', $this->data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:Pemasukan,Pengeluaran',
            'kategori' => 'required|max:100',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable',
        ]);

        Keuangan::create($validatedData);

        return redirect()->route('admin.keuangan.index')->with('success', 'Data keuangan berhasil ditambahkan.');
    }

    public function edit(Keuangan $keuangan)
    {
        $this->data['pageTitle'] = 'Edit Data Keuangan';
        $this->data['keuangan'] = $keuangan;
        return view('admin.keuangan.form', $this->data);
    }

    public function update(Request $request, Keuangan $keuangan)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:Pemasukan,Pengeluaran',
            'kategori' => 'required|max:100',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable',
        ]);

        $keuangan->update($validatedData);

        return redirect()->route('admin.keuangan.index')->with('success', 'Data keuangan berhasil diperbarui.');
    }

    public function destroy(Keuangan $keuangan)
    {
        $keuangan->delete();

        return redirect()->route('admin.keuangan.index')->with('success', 'Data keuangan berhasil dihapus.');
    }
}
