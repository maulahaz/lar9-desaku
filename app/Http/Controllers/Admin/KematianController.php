<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kematian;

class KematianController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->data['webTitle'] = env('APP_WEB_TITLE');
    }

    public function index(Request $request)
    {
        $this->data['pageTitle'] = 'Data Kematian';
        if ($request->has('reset')) {
            return redirect()->route('admin.kematian.index');
        }

        $sort = $request->input('sort', 'tanggal_kematian');
        $direction = $request->input('direction', 'desc');
        $query = Kematian::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('nama', 'LIKE', "%{$searchTerm}%")
                ->orWhere('nik', 'LIKE', "%{$searchTerm}%")
                ->orWhere('ayah', 'LIKE', "%{$searchTerm}%")
                ->orWhere('ibu', 'LIKE', "%{$searchTerm}%");
        }

        $kematians = $query->orderBy($sort, $direction)->paginate(20);
        $this->data['kematians'] = $kematians;
        $this->data['sort'] = $sort;
        $this->data['direction'] = $direction;
        $this->data['search'] = $request->input('search', '');

        return view('admin.kematian.index', $this->data);
    }

    public function create()
    {
        $this->data['pageTitle'] = 'Tambah Data Kematian';
        $this->data['kematian'] = new Kematian();
        return view('admin.kematian.form', $this->data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|string|max:16',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'agama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal_kematian' => 'required|date',
            'waktu_kematian' => 'required',
            'tempat_kematian' => 'required|string|max:255',
            'sebab_kematian' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:255',
            'profesi' => 'required|string|max:255',
            'ayah' => 'required|string|max:255',
            'ibu' => 'required|string|max:255',
        ]);

        Kematian::create($validatedData);

        return redirect()->route('admin.kematian.index')->with('success', 'Data kematian berhasil ditambahkan.');
    }

    public function edit(Kematian $kematian)
    {
        $this->data['pageTitle'] = 'Edit Data Kematian';
        $this->data['kematian'] = $kematian;
        return view('admin.kematian.form', $this->data);
    }

    public function update(Request $request, Kematian $kematian)
    {
        $validatedData = $request->validate([
            'nik' => 'required|string|max:16',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'agama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal_kematian' => 'required|date',
            'waktu_kematian' => 'required',
            'tempat_kematian' => 'required|string|max:255',
            'sebab_kematian' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:255',
            'profesi' => 'required|string|max:255',
            'ayah' => 'required|string|max:255',
            'ibu' => 'required|string|max:255',
        ]);

        $kematian->update($validatedData);

        return redirect()->route('admin.kematian.index')->with('success', 'Data kematian berhasil diperbarui.');
    }

    public function show(Kematian $kematian)
    {
        $this->data['pageTitle'] = 'Detail Kematian';
        $this->data['kematian'] = $kematian;
        return view('admin.kematian.show', $this->data);
    }

    public function destroy(Kematian $kematian)
    {
        $kematian->delete();
        return redirect()->route('admin.kematian.index')->with('success', 'Data kematian berhasil dihapus.');
    }
}